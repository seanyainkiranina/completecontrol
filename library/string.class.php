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
    private $_stringmode = false;
    /**
     * Function constructor
     *
     * @param string
     *
     * @return instance
     */
    public function __construct($string = null)
    {
        $this->_string = $this->_toString($string);
    }
    /**
     * Function set return mode
     *
     * @param bool
     */
    public function setReturnMode($bool)
    {
        $this->_stringmode = $bool;
    }
    /**
     * Function getObjectID unique id to this class.
     *
     * @return string
     *
     */
    public function getObjectID()
    {
        return $this->_objectid;
    }
    /**
     * Function overload to create dyanmic function
     *
     *
     * @param array
     *
     * @return mixed
     */
    public function __call($function, $params)
    {
        $method = $this->$function->bindto($this);
        return call_user_func_array($method, $params);
    }
    /**
     * Function get
     *
     * @param null
     *
     * @throw 'Empty string'
     *
     * @return string
     */
    public function get()
    {
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        return $this->_return($this->_string);
    }
    /**
     * Function set sets the internal string.
     *
     * @param string
     *
     * @return none
     */
    public function set($string)
    {
        $this->_string = $this->_toString($string);
    }
    /**
     * Function instances itself from xml serialized version of the object.
     *
     * @return String
     */
    public function fromSerial($serialObject)
    {

              return unserializer($serialObject);
    }
    /**
     * Function returns xml serialized version of the object.
     *
     * @return string
     *
     */
    public function toSerial()
    {

        return serialize($this);
    }
    /**
     * Function isempty checks if internal string isset
     * then if it is empty. Return of true is an empty or unset internal string
     *
     * @return bool
     *
     */
    public function isempty()
    {
        if (isset($this->_string)) {
            return (!empty($this->_string));
        }

        return true;

    }
    /**
     * Function random generate a random string .
     *
     * @param int length of string [optional default 10]
     *
     * @return string
     *
     */
    public function random($length = 10)
    {
        $base=str_shuffle(md5(microtime()));

        while (strlen($base)<(2*$length)) {
            $base .=str_shuffle(md5(microtime()));
        }

        $baselength=strlen($base);
     
        $returnString="";

        while (strlen($returnString)<$length) {
            $returnString .=$base[rand(0, $baselength-1)];
        }

 
        return $this->_return(str_shuffle($returnString));

    }
    /**
     * Function setMutable sets changablity of the internal string.
     * Setting to true causes each function to call its internal string
     *
     * @param bool
     *
     * @return none
     */
    public function setMutable($mutable)
    {
        $this->_mutable = $mutable;
    }
    /**
     * Function concat joins string passed to internal string
     * second parameter optional will concat first and second parameter
     * and set internal string if setmutable is true.
     *
     * @param string
     * @param string optional
     *
     * @return string
     */
    public function concat($string, $string2 = null)
    {
        if ($string == null) {
            throw new Exception('Empty parameter 1');
        }
        
        if ($string2 != null) {
             $returnString = $string;
             $returnString .= $string2;
             return $this->_return($returnString);

        }
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        $returnString = $this->_string;
        $returnString.= $string;
        
        return $this->_return($returnString);
    }
    /**
     * Function string contains substring
     *
     *
     * @param string
     * @param bool case insensitive
     *
     * @return bool
     */
    public function contains($searchString, $ignorecase = false)
    {
        $searchString = $this->_toString($searchString);
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        if ($ignorecase == false) {
            if (strpos($this->_string, $searchString) === false) {
                return false;
            }
        }
            
        if (stripos($this->_string, $searchString) === false) {
            return false;
        }
            
        
        return true;
    }
    /**
     * Function uc upper case version of string optional parameter
     * returned as uppercase or set the value of the internal if
     * setmutable is true.
     *
     * @param none
     *
     * @return string
     */
    public function uc($string = null)
    {
        if ($string != null) {
            return $this->_return(
                strtoupper($string)
            );
        }
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        
        return $this->_return(
            strtoupper($this->_string)
        );
    }
    /**
     * Function strstr wrapper for strstr
     *
     *
     * @param string
     * @param bool
     *
     * @return string
     */
    public function strstr($needle, $before_needle = false)
    {
        $needle = $this->_toString($needle);
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        if ($before_needle == false) {
            return $this->_return(strstr($this->_string, $needle));
        }
        
        return $this->_return(strstr($this->_string, $needle, $before_needle));
    }
    /**
     * Function substr
     *
     *
     * @param start
     * @param length (optional)
     *
     * @return string
     */
    public function substr($start, $length = null)
    {
        if ($length == null) {
            return $this->_return(substr($this->_string, $start));
        }
        
        return $this->_return(substr($this->_string, $start, $length));
    }
    /**
     * Function shuffle wrapper for str_shuffle optional parameter
     * returned as shuffle or set the value of the internal if
     * setmutable is true.
     *
     * @param string optional
     *
     * @return string
     */
    public function shuffle($string = null)
    {
        if ($string !=null) {
             return $this->_return(
                 str_shuffle($string)
             );
        }

        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        
        return $this->_return(
            str_shuffle($this->_string)
        );
    }
    /**
     * Function reverse wrapper for strrev  optional parameter
     * returned as reversed or set the value of the internal if
     * setmutable is true.
     *
     *
     * @param string optional
     *
     * @return string
     */
    public function reverse($string = null)
    {
        if ($string !=null) {
             return $this->_return(
                 strrev($string)
             );
        }


         
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        
        return $this->_return(
            strrev($this->_string)
        );
    }
    /**
     * Function lc wrapper for strolower parameter can be passed and
     * returned as lowercase or set the value of the internal if
     * setmutable is true.
     *
     *
     * @param string optional
     *
     * @return string
     */
    public function lc($string = null)
    {
        if ($string != null) {
            return $this->_return(
                strtolower($this->_string)
            );

        }
    
         
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        
        return $this->_return(
            strtolower($this->_string)
        );
    }
    /**
     * Function replace wrapper for str_replace
     *
     * @param string
     * @param string
     * @param int
     * @param bool
     *
     * @return
     */
    public function replace($search, $replace, $count = null, $ignore_case = false)
    {
        $search = $this->_toString($search);
        $replace = $this->_toString($replace);

        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        if ($count == null && $ignore_case == true) {
                return $this->_return(
                    str_ireplace($search, $replace, $this->_string)
                );
        }
        if ($count == null && $ignore_case == false) {
            return $this->_return(
                str_replace($search, $replace, $this->_string)
            );
        }

        if ($ignore_case == true) {
            return $this->_return(
                str_ireplace($search, $replace, $this->_string, $count)
            );
        }
            
            return $this->_return(
                str_replace($search, $replace, $this->_string, $count)
            );
    }
    /**
     * Function similar wrapper for similar_text
     *
     *
     * @param string
     * @return int
     */
    public function similar($string)
    {
        $string = $this->_toString($string);
        return $this->_return(similar_text($this->get(), $string));
    }
    /**
     * Function compares string wrapper for ==
     *
     *
     * @param string
     * @return bool
     */
    public function compare($string)
    {
        $string = $this->_toString($string);
        if ($this->_string == $string) {
            return true;
        }
        
        return false;
    }
    /**
     * Function toInteger wrapper for intval
     *
     *
     * @param none
     * @return int
     */
    public function toInteger()
    {
        return intval($this->_string);
    }
    /**
     * Function length Wrapper for strlen
     * if optional parameter is set returns the length of parameter
     *
     * @param string optional
     */
    public function length($string = null)
    {
        if ($string !=null) {
              return strlen($string);
        }
        
        return strlen($this->_string);
    }
    /**
     * Function wordCount wrapper for str_word_count
     * if optional parameter is set returns the word of parameter
     *
     *
     * @param string optional
     * @return int
     */
    public function wordCount($string = null)
    {
        if ($string !=null) {
            return str_word_count($string);
        }
        if ($this->_string == null) {
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
        $charlist = $this->_toString($charlist);
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        if ($cslashes != null) {
            return $this->_return(addcslashes($this->_string, $charlist));
        }
        
        return $this->_return(addslashes($this->_string));
    }
    /**
     *  Wrapper for rtrim or ltrim
     *
     */
    public function trim($character_mask = null, $left = false)
    {
        $character_mask = $this->_toString($character_mask);
        if ($left == false && $character_mask != null) {
                return $this->_return(
                    rtrim($this->_string, $character_mask)
                );
        }
            
        if ($left == false && $character_mask == null) {
                return $this->_return(
                    rtrim($this->_string)
                );
        }
        

        if ($left == true && $character_mask == null) {
            return $this->_return(
                ltrim($this->_string)
            );
        }
         
            return $this->_return(
                ltrim($this->_string, $character_mask)
            );
    }
    /**
     *  Wrapper for str_split, explode, and split.
     *
     */
    public function split($delimiter = null, $limit = null)
    {
        $delimiter = $this->_toString($delimiter);
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        if ($delimiter == null && $limit == null) {
            $this->_array = str_split($this->_string);
            if ($this->_array === false) {
                throw new Exception('Split_length is less than 1');
            }
            return $this->_array;
        }
        if ($delimiter != null && $limit == null) {
            $this->_array = explode($delimiter, $this->_string);
            if ($this->_array === false) {
                throw new Exception('Empty delimiter');
            }
            return explode($delimiter, $this->_string);
        }
        if ($delimiter == null && $limit != null) {
            return str_split($this->_string, $limit);
        }
        
        return explode($delimiter, $this->_string, $limit);
    }
    /**
     * Function  _toString polymorphic
     *
     *
     * @param mixed
     * @return string
     */
    private function _toString($string)
    {
        if ($string == null) {
            return null;
        }
        
        if (is_string($string)) {
            return $string;
        }
        
        if (is_object($string)) {
            if (method_exists($string, "getObjectID")) {
                if ($this->_objectid == $string->getObjectID()) {
                    return $string->get();
                }
            }
        }
                
            
        
        throw new Exception('String Parameter Error');
    }
    /**
     * Return
     *
     * @param string
     * @return mixed
     */
    private function _return($string)
    {
        if ($this->_mutable == true) {
            $this->_string=$string;
        }
        if ($this->_stringmode == false) {
            return $string;
        }
        
        return new String($string);
    }
    /**
     * Wrapper for strtok
     *
     */
    public function token($token = null)
    {
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        
        if ($this->_token == null) {
            if ($token == null) {
                throw new Exception('Empty token');
            }
        }
            
        
        if ($this->_token != $token) {
            $this->_token = $token;
            $this->_array = array();
            $looptok = strtok($this->_string, $this->_token);
            while ($looptok !== false) {
                $this->_array[] = $looptok;
                $looptok = strtok($this->_token);
            }
        }
        if ($this->_array == null) {
            throw new Exception('Empty array');
        }
        
        $_position_in_string++;
        if (($_position_in_string - 1) > count($this->_array)) {
            return null;
        }
        
        return $this->_return($this->_array[$position_in_string - 1]);
    }
}
