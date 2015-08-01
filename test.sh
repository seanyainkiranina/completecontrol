#!/bin/bash


php=`which php`
if [  -z $php ]
then
    echo "Cannot find php"
    exit
fi

phpunit=`which phpunit`
if [  -z $phpunit ]
then
    echo "Cannot find phpunit"
    exit
fi

phpcbf=`which phpcbf`

FILES=`ls ./library/*.php`

if [ ! -z $phpcbf ]
then
     for file in $FILES
     do
         phpcbf -w --standard=PSR2 --no-patch $file 2>&1 >/dev/null
    done
fi

errors=0

BADFILES=""

FILES=`ls ./library/*test.class.php`
     for file in $FILES
     do
        main_php_file=`echo $file | sed 's/test//g'`
        error=`php --syntax-check $main_php_file 2>&1 >/dev/null | grep -ic 'error'`

              if [ $error -ne 0 ]
              then
                    BADFILES="$BADFILES $file"
              else
                    error=`phpunit --verbose $file 2>&1 | grep -ic 'fail'`
                    if [ $error -ne 0 ]
                    then
                        BADFILES="$BADFILES $file"
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
         fi
else
     for file in $BADFILES
     do
         if [ -f $file ] 
         then 
            phpunit --verbose $file 
            echo $file
         fi
     done

fi

exit


