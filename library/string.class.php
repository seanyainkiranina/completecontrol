<?php

/*
 * This file is part of completecontrol
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 */

class String extends stdClass
{

     private $_string = null;
     private $_array = null;
     private $_token = null;
     private $_position_in_string = 0;
     private $_mutable = false;
     private $_objectid = '0715221c-59e8-9589-434093851da8';

     /**
      * Function constructor
      *
      * @return instance
      *
      * @param string
      */
     public function __construct($string = null)
     {
            $this->_string=$this->_toString($string);
     }

     
     /**
      * Function getObjectID unique id to this class.
      *
      * @return string
      * 
      */
      public function getObjectID()
      {

          return $_objectid;

     }

     /**
      * Function overload to create dyanmic function
      *
      * @return mixed
      *
      * @param array
      */
        public function __call($function, $params)
        {

             $method = $this->$function->bindto($this);
            return call_user_func_array($method, $params);

        }

     /**
      * Function get 
      *
      * @return string
      *
      * @throw 'Empty string'
      * 
      * @param null
      */
        public function get()
        {

            if ($this->_string==null) {
                 throw new Exception('Empty string');
            }

            return $this->_string;

        }
     /**
      * Function set sets the internal string.
      *
      * @return none
      *
      * @param string
      */
        public function set($string)
        {
            $this->_string=$this->_toString($string);

        }
     /**
      * Function setMutable sets changablity of the internal string.
      * Setting to true causes each function to call its internal string
      *
      * @return none
      *
      * @param bool
      */
        public function setMutable($mutable)
        {

            $this->_mutable=$mutable;

        }

     /**
      * Function concat joins string passed to internal string
      *
      * @return string 
      *
      * @param string
      */
        public function concat($string)
        {
            $string=$this->_toString($string);

            if ($this->_string==null) {
                 throw new Exception('Empty string');
            }

             $returnString = $this->_string;
             $returnString .= $string;

            if ($this->_mutable==true) {
                $this->_string=$returnString;
            }
        
            return $returnString;

        }

     /**
      * Function string contains substring
      *
      * @return bool
      *
      * @param string 
      * @param bool case insensitive
      *
      */
        public function contains($searchString, $ignorecase = false)
        {
            $searchString=$this->_toString($searchString);

            if ($this->_string==null) {
                 throw new Exception('Empty string');
            }

            if ($ignorecase==false) {
                if (strpos($this->_string, $searchString)===false) {
                    return false;
                }
            } else {
                  return true;
            }


            if ($ignorecase==true) {
                if (stripos($this->_string, $searchString)===false) {
                       return false;
                }
            }


                return true;



        }

     /**
      * Function uc upper case version of string
      *
      * @return string
      *
      * @param none
      */
        public function uc()
        {
            if ($this->_string==null) {
                 throw new Exception('Empty string');
            }

            $uppercase= strtoupper($this->_string);
            if ($this->_mutable==true) {
                $this->_string=$uppercase;
            }

            return $uppercase;


        }

     /**
      * Function strstr wrapper for strstr
      *
      * @return string
      *
      * @param string
      * @param bool
      */
        public function strstr($needle, $before_needle = false)
        {
            $needle=$this->_toString($needle);

            if ($this->_string==null) {
                 throw new Exception('Empty string');
            }

            if ($before_needle==false) {
                return strstr($this->_string, $needle);

            }


            return strstr($this->_string, $needle, $before_needle);

        }
   
     /**
      * Function substr 
      *
      * @param string
      *
      * @return start
      * @return length (optional)
      */
        public function substr($start, $length = null)
        {

            if ($length==null) {
                return substr($this->_string, $start);
  


            }
              return substr($this->_string, $start, $length);

        }

     /**
      * Function shuffle wrapper for str_shuffle
      *
      * @return string
      *
      * @param nothing
      */
        public function shuffle()
        {
            if ($this->_string==null) {
                 throw new Exception('Empty string');
            }

            $returnString=str_shuffle($this->_string);

            if ($this->_mutable==true) {
                 $this->_string=$returnString;
            }

            return $returnString;


        }

     /**
      * Function reverse wrapper for strrev
      *
      * @return string
      *
      * @param nothing
      */
        public function reverse()
        {
            if ($this->_string==null) {
                 throw new Exception('Empty string');
            }

            $returnString= strrev($this->_string);
            if ($this->_mutable==true) {
                 $this->_string=$returnString;
            }


            return $returnString;

        }


     /**
      * Function lc wrapper for strolower
      *
      * @return string
      *
      * @param nothing
      */

        public function lc()
        {
            if ($this->_string==null) {
                 throw new Exception('Empty string');
            }

            $returnString= strtolower($this->_string);
            if ($this->_mutable==true) {
                 $this->_string=$returnString;
            }

             return $returnString;
     
        }

   
     /**
      * Function replace wrapper for str_replace
      *
      * @return
      *
      * @param string
      * @param string
      * @param int
      * @param bool
      */
        public function replace(
            $search,
            $replace,
            $count = null,
            $ignore_case = false
        ) {

            $search=$this->_toString($search);

            $replace=$this->_toString($replace);


         if ($this->_string==null) {
               throw new Exception('Empty string');
            }


            if ($count==null) {
                if ($ignore_case==true) {
                    $returnString= str_ireplace($search, $replace, $this->_string);
                    if ($this->_mutable==true) {
                         $this->_string=$returnString;
                    }

                    return $returnString;

                }
            } else {
                       $returnString= str_replace($search, $replace, $this->_string);
                if ($this->_mutable==true) {
                    $this->_string=$returnString;
                }

                       return $returnString;

 
            }

            if ($ignore_case==true) {
                $returnString= str_ireplace($search, $replace, $this->_string, $count);
                if ($this->_mutable==true) {
                      $this->_string=$returnString;
                }

                return $returnString;
            } else {
                $returnString= str_replace($search, $replace, $this->_string, $count);
                if ($this->_mutable==true) {
                      $this->_string=$returnString;
                }

                return $returnString;

            }


        }


     /**
      * Function similar wrapper for similar_text
      *
      * @return int
      *
      * @param string
      */

        public function similar($string)
        {
            $string=$this->_toString($string);

            return similar_text($this->get(), $string);

        }

     /**
      * Function compares string wrapper for == 
      *
      * @return bool
      *
      * @param string
      */
        public function compare($string)
        {
        
            $string=$this->_toString($string);

            if ($this->_string==$string) {
                  return true;

            }

            return false;

        }


     /**
      * Function toInteger wrapper for intval
      *
      * @return int
      *
      * @param none
      */
    
        public function toInteger()
        {
            return intval($this->_string);


        }
 
     /**
     *  Function length Wrapper for strlen
     */
        public function length()
        {
            return strlen($this->_string);

        }


     /**
      * Function wordCount wrapper for str_word_count
      *
      * @return int
      *
      * @param nothing
      */

        public function wordCount()
        {
            if ($this->_string==null) {
                throw new Exception('Empty string');
            }

            return str_word_count($this->_string);


        }
   


     /**
     *  Wrapper for addcslashes and addslashes
     *  Quote string with slashes.
     */
        public function quote($charlist = null)
        {
            $charlist=$this->_toString($charlist);

            if ($this->_string==null) {
                throw new Exception('Empty string');
            }

            if ($cslashes !=null) {
                 return addcslashes($this->_string, $charlist);


            }
                  return addslashes($this->_string);


        }
 
    /**
    *  Wrapper for rtrim or ltrim
    *
    */
        public function trim($character_mask = null, $left = false)
        {
            $character_mask=$this->_toString($character_mask);

            if ($left==false) {
                if ($character_mask==null) {
                      $returnString= rtrim($this->_string);
                      return $returnString;

                }
            } else {
                $returnString= rtrim($this->_string, $character_mask);
                return $returnString;

            }

            if ($character_mask==null) {
                  $returnString= ltrim($this->_string);

                  return $returnString;

            } else {
                $returnString=ltrim($this->_string, $character_mask);

                return $returnString;

            }

        }


    /**
    *  Wrapper for str_split, explode, and split.
    *
    */
        public function split($delimiter = null, $limit = null)
        {
            $delimiter=$this->_toString($delimiter);

            if ($this->_string==null) {
                throw new Exception('Empty string');
            }

            if ($delimiter==null && $limit==null) {
                $this->_array=str_split($this->_string);

                if ($this->_array===false) {
                    throw new Exception('Split_length is less than 1');
                }

                    return $this->_array;

            }
           

            if ($delimiter !=null && $limit==null) {
                    $this->_array=explode($delimiter, $this->_string);

                if ($this->_array===false) {
                    throw new Exception('Empty delimiter');
                }
              
                    return explode($delimiter, $this->_string);
            }

            if ($delimiter==null && $limit!=null) {
                return str_split($this->_string, $limit);
            }

             return explode($delimiter, $this->_string, $limit);


        }
   
        
     /**
      * Function  _toString polymorphic 
      *
      * @return string
      * 
      * @param String object | string | null
      */
         private function _toString($string){

           if ($string == null)
                 return null;

           if (is_string($string))
                return $string;

           if (is_object($string))
                if (method_exists($string,"getObjectID"))
                   if ($this->_objectid == $string->getObjectID())
                                 return $string->get();

           throw new Exception('String Parameter Error');

        }

    /**
    * Wrapper for strtok
    *
    */
        public function token($token = null)
        {
            if ($this->_string==null) {
                throw new Exception('Empty string');
            }

            if ($this->_token==null) {
                if ($token==null) {
                    throw new Exception('Empty token');
                }
            }

            if ($this->_token != $token) {
                $this->_token=$token;
               
                 $this->_array=array();

                 $looptok=strtok($this->_string, $this->_token);

                while ($looptok !==false) {
                    $this->_array[] = $looptok;
                      
                    $looptok=strtok($this->_token);

                }

            }

            if ($this->_array==null) {
                throw new Exception('Empty array');
            }

             $_position_in_string++;

            if (($_position_in_string-1) > count($this->_array)) {
                return null;
            }

               return $this->_array[$position_in_string-1];

        }
}
