<?php
namespace completecontrol;

/**
 * This file is part of completecontrol
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
*/
class String extends \stdClass
{
    private $string = null;
    private $array = null;
    private $token = null;
    private $positioninstring = 0;
    private $mutable = false;
    private $objectid = '0715221c-59e8-9589-434093851da8';
    private $stringmode = false;
    /**
     * Function constructor
     *
     * @param string
     *
     * @return instance
     */
    public function __construct($string = null)
    {
        $this->string = $this->toString($string);
    }
    /**
     * Function set return mode
     *
     * @param bool
     */
    public function setReturnMode($bool)
    {
        $this->stringmode = $bool;
    }
    /**
     * Function getObjectID unique id to this class.
     *
     * @return string
     *
     */
    public function getObjectID()
    {
        return $this->objectid;
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
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        return $this->returnString($this->string);
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
        $this->string = $this->toString($string);
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
        if (isset($this->string)) {
            return (!empty($this->string));
        }

        return true;

    }
    /**
     * Function random generate a random string.
     *
     * @param int length of string [optional default 10]
     *
     * @return string
     *
     */
    public function random($length = 10)
    {
        if (!is_numeric($length)) {
            throw new \Exception('Non numeric parameter');
        }

        $base=str_shuffle(md5(microtime()));

        while (strlen($base)<(pow($length, 2))) {
            $base .=str_shuffle(md5(microtime()));
        }

     
        $base=str_shuffle($base);
     
        $baselength=strlen($base);

        $returnString="";

        while (strlen($returnString)<$length) {
            $returnString .=$base[rand(0, $baselength-1)];
        }

 
        return $this->returnString(str_shuffle($returnString));

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
        $this->mutable = $mutable;
    }
    /**
     * Function concat joins string passed to internal string
     * second parameter optional will concat first and second parameter
     * and set internal string if setmutable is true.
     *
     * @param string
     * @param string optional
     *
     * @return
     */
    public function concat($string, $string2 = null)
    {
        if ($string == null) {
            throw new \Exception('Empty parameter 1');
        }
        
        if ($string2 != null) {
             $returnString = $string;
             $returnString .= $string2;
             return $this->returnString($returnString);
        }
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        $returnString = $this->string;
        $returnString.= $string;
        
        return $this->returnString($returnString);
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
        $searchString = $this->toString($searchString);
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        if ($ignorecase == false) {
            if (strpos($this->string, $searchString) === false) {
                return false;
            }
        }
            
        if (stripos($this->string, $searchString) === false) {
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
            return $this->returnString(
                strtoupper($string)
            );
        }
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        
        return $this->returnString(
            strtoupper($this->string)
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
    public function strstr($needle, $beforeneedle = false)
    {
        $needle = $this->toString($needle);
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        if ($beforeneedle == false) {
            return $this->returnString(strstr($this->string, $needle));
        }
        
        return $this->returnString(strstr($this->string, $needle, $beforeneedle));
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
            return $this->returnString(substr($this->string, $start));
        }
        
        return $this->returnString(substr($this->string, $start, $length));
    }
    /**
     * Function shuffle wrapper for strshuffle optional parameter
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
             return $this->returnString(
                 strshuffle($string)
             );
        }

        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        
        return $this->returnString(
            str_shuffle($this->string)
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
             return $this->returnString(
                 strrev($string)
             );
        }


         
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        
        return $this->returnString(
            strrev($this->string)
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
            return $this->returnString(
                strtolower($this->string)
            );
        }
    
         
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        
        return $this->returnString(
            strtolower($this->string)
        );
    }
    /**
     * Function replace wrapper for strreplace
     *
     * @param string
     * @param string
     * @param int
     * @param bool
     *
     * @return
     */
    public function replace($search, $replace, $count = null, $ignorecase = false)
    {
        $search = $this->toString($search);
        $replace = $this->toString($replace);

        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        if ($count == null && $ignorecase == true) {
                return $this->returnString(
                    str_ireplace($search, $replace, $this->string)
                );
        }
        if ($count == null && $ignorecase == false) {
            return $this->returnString(
                str_replace($search, $replace, $this->string)
            );
        }

        if ($ignorecase == true) {
            return $this->returnString(
                str_ireplace($search, $replace, $this->string, $count)
            );
        }
            
            return $this->returnString(
                str_replace($search, $replace, $this->string, $count)
            );
    }
    /**
     * Function similar wrapper for similartext
     *
     *
     * @param string
     * @return int
     */
    public function similar($string)
    {
        $string = $this->toString($string);
        return $this->returnString(similartext($this->get(), $string));
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
        $string = $this->toString($string);
        if ($this->string == $string) {
            return true;
        }
        
        return false;
    }
    /**
     * Function toInteger wrapper for intval
     * optional parameter returns as integer
     *
     * @param string optional
     * @return int
     */
    public function toInteger($string = null)
    {
        if ($string !=null) {
            return intval($string);
        }
        return intval($this->string);
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
        
        return strlen($this->string);
    }
    /**
     * Function wordCount wrapper for strwordcount
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
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        return str_word_count($this->string);
    }
    /**
     *  Guid generator
     *  if mutable is set sets internal string
     */
    public function guid()
    {
        if (function_exists('comcreateguid')) {
                return $this->returnString(trim(
                    com_create_guid(),
                    '{}'
                ));
        }

              return $this->returnString(
                  $this->random(8) ."-".
                  $this->random(4) ."-".
                  $this->random(4) ."-".
                  $this->random(4) ."-".
                  $this->random(12)
              );
         
    }

    /**
     *  Wrapper for addcslashes and addslashes
     *  Quote string with slashes.
     */
    public function quote($charlist = null)
    {
        $charlist = $this->toString($charlist);
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        if ($cslashes != null) {
            return $this->returnString(addcslashes($this->string, $charlist));
        }
        
        return $this->returnString(addslashes($this->string));
    }
    /**
     *  Wrapper for rtrim or ltrim
     *
     */
    public function trim($charactermask = null, $left = false)
    {
        $charactermask = $this->toString($charactermask);
        if ($left == false && $charactermask != null) {
                return $this->returnString(
                    rtrim($this->string, $charactermask)
                );
        }
            
        if ($left == false && $charactermask == null) {
                return $this->returnString(
                    rtrim($this->string)
                );
        }
        

        if ($left == true && $charactermask == null) {
            return $this->returnString(
                ltrim($this->string)
            );
        }
         
            return $this->returnString(
                ltrim($this->string, $charactermask)
            );
    }
    /**
     *  Wrapper for strsplit, explode, and split.
     *
     */
    public function split($delimiter = null, $limit = null)
    {
        $delimiter = $this->toString($delimiter);
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        if ($delimiter == null && $limit == null) {
            $this->array = str_split($this->string);
            if ($this->array === false) {
                throw new \Exception('Splitlength is less than 1');
            }
            return $this->array;
        }
        if ($delimiter != null && $limit == null) {
            $this->array = explode($delimiter, $this->string);
            if ($this->array === false) {
                throw new \Exception('Empty delimiter');
            }
            return explode($delimiter, $this->string);
        }
        if ($delimiter == null && $limit != null) {
            return str_split($this->string, $limit);
        }
        
        return explode($delimiter, $this->string, $limit);
    }
    /**
     * Function  toString polymorphic
     *
     *
     * @param mixed
     * @return string
     */
    private function toString($string)
    {
        if ($string == null) {
            return null;
        }
        
        if (is_string($string)) {
            return $string;
        }
        
        if (is_object($string)) {
            if (method_exists($string, "getObjectID")) {
                if ($this->objectid == $string->getObjectID()) {
                    return $string->get();
                }
            }
        }
                
            
        
        throw new \Exception('String Parameter Error');
    }
    /**
     * Return
     *
     * @param string
     * @return mixed
     */
    private function returnString($string)
    {
        if ($this->mutable == true) {
            $this->string=$string;
        }
        if ($this->stringmode == false) {
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
        if ($this->string == null) {
            throw new \Exception('Empty string');
        }
        
        if ($this->token == null) {
            if ($token == null) {
                throw new \Exception('Empty token');
            }
        }
            
        
        if ($this->token != $token) {
            $this->token = $token;
            $this->array = array();
            $looptok = strtok($this->string, $this->token);
            while ($looptok !== false) {
                $this->array[] = $looptok;
                $looptok = strtok($this->token);
            }
        }
        if ($this->array == null) {
            throw new \Exception('Empty array');
        }
        
        $positioninstring++;
        if (($positioninstring - 1) > count($this->array)) {
            return null;
        }
        
        return $this->returnString($this->array[$positioninstring - 1]);
    }
}
