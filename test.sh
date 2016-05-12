#!/bin/bash
##########################################################################
#  Bash script to run unit testing and PSR2 formatting
# Adding a argument uses the arguenent to commit the changes to git repo
# if there are no unit or php test errors.
##########################################################################

if [ ! -z "$1" ]
then 
	cd ./library/
        git commit -ma "$1"
fi
# Test to make sure php is in path
php=`which php`
if [  -z $php ]
then
    echo "Cannot find php"
    exit
fi


# Test to make sure phpunit is in path
phpunit=`which phpunit`
if [  -z $phpunit ]
then
    echo "Cannot find phpunit"
    exit
fi

# Test to make sure phpmd is in path
phpmd=`which phpmd`
if [  -z $phpmd ]
then
    echo "Cannot find phpmd"
    exit
fi

md=`$phpmd ./library/ text design naming unusedcode cleancode`


mdlines=`echo $md | wc -l`

if [ $mdlines -ne 0 ]
then
	echo "Ignore ...variadic.. errors "
	echo $md
fi

# Test to make sure phpcbf is in path
# if its not we just don't do the PSR2
phpcbf=`which phpcbf`

if [ ! -z $phpcbf ]
then
      phpcbf --report=diff -vv -w --standard=PSR2 --no-patch ./library/ 
fi

phpcs=`which phpcs`
if [ ! -z $phpcs ]
then
	phpcs --standard=PSR2 ./library/ | less
fi


# No errors so far
errors=0

BADFILES=""

# All unit test files must be named [class]test.class.php
FILES=`ls ./library/*test.class.php`
     for file in $FILES
     do
        main_php_file=`echo $file | sed 's/test//g'`
        error=`php --syntax-check $main_php_file 2>&1 >/dev/null | grep -ic 'error'`
              if [ $error -ne 0 ]
              then
                    BADFILES="$BADFILES $file"
              else
                    error=`phpunit --verbose $file 2>&1 | grep -ic 'fail\|error'`
                    if [ $error -ne 0 ]
                    then
                        BADFILES="$BADFILES $file"
              	    else
                    	error=`php $main_php_file 2>&1 | grep -ic 'error'`
                    	if [ $error -ne 0 ]
                    	then
                        	BADFILES="$BADFILES $file"
		
                    	fi 
                    fi 
              fi 

       errors=`expr $errors + $error`
    done
if [ $errors -eq 0 ]
then
   echo "No errors"
   cd ./library/
   git add *.php
         if [ ! -z "$1" ]
         then 
            git commit -m "$1"
            git push
         fi
else
     for file in $BADFILES
     do
# Syntax errors will fail on the unit test also 
# Show what failed by rerunning the unit test on the bad files

         if [ -f $file ] 
         then 
            phpunit --verbose $file 
            echo $file
         fi
     done

fi

exit


