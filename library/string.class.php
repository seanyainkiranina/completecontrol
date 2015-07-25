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
class String extends stdClass {
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
    public function __construct($string = null) {
        $this->_string = $this->_toString($string);
    }
    /**
     * Function set return mode
     *
     * @param bool
     */
    public function setReturnMode($bool) {
        $this->_stringmode = $bool;
    }
    /**
     * Function getObjectID unique id to this class.
     *
     * @return string
     *
     */
    public function getObjectID() {
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
    public function __call($function, $params) {
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
    public function get() {
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
    public function set($string) {
        $this->_string = $this->_toString($string);
    }
    /**
     * Function setMutable sets changablity of the internal string.
     * Setting to true causes each function to call its internal string
     *
     * @param bool
     *
     * @return none
     */
    public function setMutable($mutable) {
        $this->_mutable = $mutable;
    }
    /**
     * Function concat joins string passed to internal string
     *
     * @param string
     *
     * @return string
     */
    public function concat($string) {
        $string = $this->_toString($string);
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        $returnString = $this->_string;
        $returnString.= $string;
        if ($this->_mutable == true) {
            $this->_string = $returnString;
        }
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
    public function contains($searchString, $ignorecase = false) {
        $searchString = $this->_toString($searchString);
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        if ($ignorecase == false) {
            if (strpos($this->_string, $searchString) === false) {
                return false;
            }
        } else {
            return true;
        }
        if ($ignorecase == true) {
            if (stripos($this->_string, $searchString) === false) {
                return false;
            }
        }
        return true;
    }
    /**
     * Function uc upper case version of string
     *
     * @param none
     *
     * @return string
     */
    public function uc() {
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        $uppercase = strtoupper($this->_string);
        if ($this->_mutable == true) {
            $this->_string = $uppercase;
        }
        return $this->_return($uppercase);
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
    public function strstr($needle, $before_needle = false) {
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
    public function substr($start, $length = null) {
        if ($length == null) {
            return $this->_return(substr($this->_string, $start));
        }
        return $this->_return(substr($this->_string, $start, $length));
    }
    /**
     * Function shuffle wrapper for str_shuffle
     *
     * @param nothing
     *
     * @return string
     */
    public function shuffle() {
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        $returnString = str_shuffle($this->_string);
        if ($this->_mutable == true) {
            $this->_string = $returnString;
        }
        return $this->_return($returnString);
    }
    /**
     * Function reverse wrapper for strrev
     *
     *
     * @param nothing
     *
     * @return string
     */
    public function reverse() {
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        $returnString = strrev($this->_string);
        if ($this->_mutable == true) {
            $this->_string = $returnString;
        }
        return $this->_return($returnString);
    }
    /**
     * Function lc wrapper for strolower
     *
     *
     * @param nothing
     *
     * @return string
     */
    public function lc() {
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        $returnString = strtolower($this->_string);
        if ($this->_mutable == true) {
            $this->_string = $returnString;
        }
        return $this->_return($returnString);
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
    public function replace($search, $replace, $count = null, $ignore_case = false) {
        $search = $this->_toString($search);
        $replace = $this->_toString($replace);
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        if ($count == null) {
            if ($ignore_case == true) {
                $returnString = str_ireplace($search, $replace, $this->_string);
                if ($this->_mutable == true) {
                    $this->_string = $returnString;
                }
                return $this->_return($returnString);
            }
        } else {
            $returnString = str_replace($search, $replace, $this->_string);
            if ($this->_mutable == true) {
                $this->_string = $returnString;
            }
            return $this->_return($returnString);
        }
        if ($ignore_case == true) {
            $returnString = str_ireplace($search, $replace, $this->_string, $count);
            if ($this->_mutable == true) {
                $this->_string = $returnString;
            }
            return $this->_return($returnString);
        } else {
            $returnString = str_replace($search, $replace, $this->_string, $count);
            if ($this->_mutable == true) {
                $this->_string = $returnString;
            }
            return $this->_return($returnString);
        }
    }
    /**
     * Function similar wrapper for similar_text
     *
     *
     * @param string
     * @return int
     */
    public function similar($string) {
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
    public function compare($string) {
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
    public function toInteger() {
        return intval($this->_string);
    }
    /**
     *  Function length Wrapper for strlen
     */
    public function length() {
        return strlen($this->_string);
    }
    /**
     * Function wordCount wrapper for str_word_count
     *
     *
     * @param nothing
     * @return int
     */
    public function wordCount() {
        if ($this->_string == null) {
            throw new Exception('Empty string');
        }
        return str_word_count($this->_string);
    }
    /**
     *  Wrapper for addcslashes and addslashes
     *  Quote string with slashes.
     */
    public function quote($charlist = null) {
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
    public function trim($character_mask = null, $left = false) {
        $character_mask = $this->_toString($character_mask);
        if ($left == false) {
            if ($character_mask == null) {
                $returnString = rtrim($this->_string);
                return $this->_return($returnString);
            }
        } else {
            $returnString = rtrim($this->_string, $character_mask);
            return $this->_return($returnString);
        }
        if ($character_mask == null) {
            $returnString = ltrim($this->_string);
            return $this->_return($returnString);
        } else {
            $returnString = ltrim($this->_string, $character_mask);
            return $this->_return($returnString);
        }
    }
    /**
     *  Wrapper for str_split, explode, and split.
     *
     */
    public function split($delimiter = null, $limit = null) {
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
    private function _toString($string) {
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
    private function _return($string) {
        if ($this->_stringmode == false) {
            return $string;
        }
        return new String($string);
    }
    /**
     * Wrapper for strtok
     *
     */
    public function token($token = null) {
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
