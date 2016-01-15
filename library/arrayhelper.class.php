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
class ArrayHelper extends stdClass
{
<<<<<<< HEAD
    private $_value = 7;
=======
    private $_value = 5;
>>>>>>> 2fb71ff181cd99432cf21ed6637659c6526bfa48
    private $_objectid = '0715221d-59e8-9689-434093851da8';
    private $_mutable = false;
    /**
     * Function constructor
     *
     *
     * @param mixed
     *
     * @return instance
     */
    public function __construct($param = null)
    {
        $this->_value = $param;
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
     * @return numeric
     *
     * @throw 'Empty string'
     *
     * @param null
     */
    public function get()
    {
        return $this->_value;
    }
    /**
     * Function set sets the internal numeric
     *
     *
     * @param mixed
     *
     * @return none
     */
    public function set($parameter)
    {
        $this->_value = $parameter;
    }
    /**
     * Function setMutable sets changablity of the internal string.
     * Setting to true causes each function to call its internal string
     *
     *
     * @param bool
     *
     * @return none
     */
    public function setMutable($mutable)
    {
        if (!is_bool($mutable)) {
            throw new Exception('Non boolean parameter');
        }
        
        $this->_mutable = $mutable;
    }
    /**
     * Function instances itself from xml serialized version of the object.
     *
     * @return Decimal
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
     * Function rand returns 1 or more entries
     *
     *
     * @return mixed
     */
    public function random($count = 1)
    {
        if ($count==1) {
               $return_value=array_rand($this->_value, $count);

               $this->_value=$return_value;

               return $return_value[0];
        }
    
        return $this->_return(array_rand($this->_value, $count));
    }
    /**
     * Function splits array into chunks defaults to half
     *
     * @param integer
     *
     * @return array
     */
    public function splitArray($size = null, $array = null)
    {
        $temparray=$this->_value;
        if (is_array($array)) {
            $temparray=$array;
        }
        if ($size==null) {
            $size=intval(count($temparray)/2);
        }
        return $this->_return(
            array_chuck($temparray, $size)
        );
    }
    /**
     * Function returns one column of an array
     *
     * @param mixed
     *
     * @return array
     */
    public function column($key = null)
    {
        if ($key==null) {
            throw new Exception('Key Required');
        }

        return $this->_return(array_column($this->_value, $key));
    }
    /**
     * Function combines array of keys with array of values
     *
     * @param array
     * @param array
     *
     * @return array
     */
    public function combined($keyArray, $valueArray)
    {
        if (!is_array($keyArray) || !is_array($valueArray)) {
            throw new Exception('Invalid Parameters');
        }

        return $this->_return(array_combine($keyArray, $valueArray));
    }
    /**
     * Function counts the number of values and returns an array of counts of
     * values
     *
     * @return array
     */
    public function countValues()
    {
        return $this->_return(array_count_values($this->_value));
    }
    /**
     * Function create an array of sequence of indexes same value
     *
     * @return array
     */
    public function fill($startIndex, $endIndex, $value)
    {
        return $this->_return(
            array_fill($startIndex, ($endIndex-$startIndex), $value)
        );
    }
    /**
     * Function exchange keys for values.
     *
     *
     * @return array
     */
    public function exchange($array = null)
    {
        $tempArray=$this->_value;

        if (is_array($array)) {
            $tempArray=$array;

        }
        return $this->_return(
            array_flip($tempArray)
        );

    }
    /**
     * Function iterates over array passing key and value to callback
     * if return of callback is true returns value and key to
     * returned array
     *
     * @return array
     */
    public function filter($callback, $array = null)
    {
        $tempArray=$this->_value;
        if (is_array($array)) {
            $tempArray=$array;

        }
        if (!is_function($callback)) {
            throw new Exception('Invalid Parameter');
        }
     
        return $this->_return(
            array_filter($tempArray, $callback, ARRAY_FILTER_USE_BOTH)
        );

    }
    /**
     * Function returns an array of all the values present in each array
     * @param array
     * @param array | optional
     *
     * @return array
     */
    public function intersect($array, $array2 = null)
    {
        $tempArray =$this->_value;

        if (is_array($array)) {
            $tempArray =$array2;
        }

        if (!is_array($array)) {
            throw new Exception('Invalid Parameter');
        }

        return $this->_return(
            array_intersect($tempArray, $array)
        );
    }
    /**
     * Function returns keys of array
     *
     * @return array
     */
    public function keys($search = null, $array = null)
    {
        if ($array!=null && !is_array($array)) {
            throw new Exception('Invalid Parameter');
        }

        if ($search!=null && $array!=null) {
            return $this->_return(array_keys($array, $search));
        }
        if ($search==null && $array !=null) {
            return $this->_return(array_keys($array));
        }
        if ($search !=null && $array==null) {
            return $this->_return(array_keys($this->value, $search));
        }
            return $this->_return(array_keys($this->value));
    }
    /**
     * Function returns values of array
     *
     * @return array
     */
    public function values($search = null, $array = null)
    {
        if ($array!=null && !is_array($array)) {
            throw new Exception('Invalid Parameter');
        }
        if ($array !=null && $search==null) {
            return $this->_return(array_values($array));
        }
        if ($array !=null && $search !=null) {
            return $this->_return(
                array_values(
                    array_search($search, $array)
                )
            );
        }
        if ($search !=null) {
            return $this->_return(
                array_values(
                    array_search($search, $this->value)
                )
            );

        }

            return $this->_return(array_values($this->value));
    }
    /**
     * Check if value in array
     *
     * @param mixed
     * @param array | optional
     *
     * @return bool
     */
    public function in($value, $array = null)
    {
        if ($array==null || (!is_array($array))) {
             return in_array($value, $this->_value, true);
        }

               return in_array($value, $array, true);

    }
    /**
     * Implode explode string by deliminater into array
     * @param string
     * @param string
     *
     * @return array
     */
    public function fromLine($deliminater, $string)
    {

         return $this->_return(explode($deliminater, $string));

    }
    /**
     * Implode array into string with deliminater
     *
     * @param string
     * @param array | optional
     *
     * @return string
     */
    public function toLine($deliminater, $array = null)
    {
        if ($array==null || (!is_array($array))) {
             return implode($deliminater, $this->_value);
        }
         
             return implode($deliminater, $array);
    }
    /**
     * Compact variables into key name value array
     *
     * @param mixed
     *
     * @return array
     */
    public function compactVariables(...$values)
    {

            return $this->_return(compact($values));
    }
    /**
     * Function reduce the array into a single value
     * callback on values of array
     * callback (mixed carry , nixed $item)
     *
     * @param function
     * @param array | optional
     * @return mixed
     */
    public function reduce($callback, $array = null)
    {
        if (!is_function($callback)) {
            throw new Exception('Parameter 1 must be a function');
        }
       
        $temparray=$this->_value;
        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter 2 must be an array');
        } else {
            $temparray=$array;
        }

        return array_reduce($temparray, $callback);


    }
    /**
     * Function map applies callback on values of array
     *
     * @return array
     */
    public function map($callback, $array = null)
    {
        $temparray=$this->_value;
        if (!is_function($callback)) {
            throw new Exception('Invalid Parameter');
        }
        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter 2 must be an array');
        } else {
            $temparray=$array;

        }
            return $this->_return(array_map($callback, $temparray));
    }
    /**
     * Function push element on to the front of an array
     * if first arguement is an array and ther are more then one parameter
     * remaining arguments are pushed to first arguement
     *
     * @param mixed
     *
     * @return mixed
     */
    public function unshift(...$values)
    {
        $temparray=$this->_value;
        if ((count($values))>1) {
            if (is_array($values[0])) {
                $temparray=array_unshift($values);
            }
        }
        foreach ($values as $value) {
            $test_count=count($temparray);

            if (($test_count+1) != $tested_count) {
                 throw new Exception('Value could not be pushed');
            }
        }

        if ($this->_mutable == true) {
            $this->value = $temparray;
        }

        return $temparray;
    }
    /**
     * Function push element on to the end of array
     * if first arguement is an array and ther are more then one parameter
     * remaining arguments are pushed to first arguement
     *
     * @param mixed
     *
     * @return mixed
     */
    public function push(...$values)
    {
        $temparray=$this->_value;

        if (count($values)>1) {
            if (is_array($values[0])) {
                $temparray=array_unshift($values);

            }
        }
        foreach ($values as $value) {
            $test_count=count($temparray);

            $tested_count=array_push($temparray, $value);
    
            if (($test_count+1) != $tested_count) {
                 throw new Exception('Value could not be pushed');
            }

        }
        if ($this->_mutable == true) {
            $this->value = $temparray;

        }

        return $temparray;
    }
    /**
     * Function pop element off the end of array
     *
     * @param mixed
     *
     * @return mixed
     */
    public function pop($array = null)
    {
        $tempArray=$this->_value;

        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter must be an array');
        } else {
            if ($array !=null && is_array($array)) {
                $tempArray=$array;
            }
        }
        $returnValue=array_pop($tempArray);

        if ($this->_mutable == true) {
            $this->_value=$tempArray;

        }
        return $returnValue;
    }
    /**
     * Function sort returns a sorted array
     * sort_flag 0 SORT_REGULAR, 1 SORT_NUMERIC, 2 SORT_STRING
     * 3 SORT_LOCALE_STRING,
     * 4 SORT_NATURAL,
     * 5 SORT_FLAG_CASE
     * sort_options 0 VALUE, 1 MAINTAIN_KEY, 2 SORT_KEY
     *
     * @param int
     * @param mixed
     *
     * @return array
     */
    public function sort(
        $sort_flag = 0,
        $sort_option = 0,
        $reverse = false,
        $array = null
    ) {
        $temparray=$this->_value;
        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter must be an array');
        }
        if (is_array($array)) {
                $temparray=$array;
        }
        $whichSort="sort";
        switch ($sort_option){
            case 0:
                $whichSort="sort";
                if ($reverse==true) {
                    $whichSort="rsort";
                }
                break;
            case 1:
                $whichSort="asort";
                if ($reverse==true) {
                    $whichSort="arsort";
                }
                break;
            case 2:
                $whichSort="ksort";
                if ($reverse==true) {
                    $whichSort="krsort";
                }
                break;
            default:
                throw new Exception('Invaild sort option');
                break;
        }

        $success=false;
        switch ($sort_flag){
            case 0:
                $success=$whichSort($temparray,SORT_REGULAR);
                break;
            case 1:
                $success=$whichSort($temparray,SORT_NUMERIC);
                break;
            case 2:
                $success=$whichSort($temparray,SORT_STRING);
                break;
            case 3:
                $success=$whichSort($temparray,SORT_LOCALE_STRING);
                break;
            case 4:
                $success=$whichSort($temparray,SORT_NATURAL);
                break;
            case 5:
                $success=$whichSort($temparray,SORT_FLAG_CASE);
                break;
            default:
                throw new Exception('Invaild sort flag');
                break;
        }
        if ($success==false) {
            throw new Exception('Failed Sort');
        }
       
           return $this->_return($temparray);

    }
    /**
     * Function slice extracts a slice of an array
     *
     * @param int
     * @param int
     *
     * @return array
     */
    public function slice($start, $length, $array = null)
    {
        $temparray=$this->_value;
        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter must be an array');
        }
        if (is_array($array)) {
            $temparray=$array;
        }
           return $this->_return(
               array_slice($temparray, $start, $length)
           );

    }
    /**
     * Function reverses array
     *
     * @param mixed
     *
     * @return array
     */
    public function reverse($array = null)
    {
        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter must be an array');
        }
        $temparray=$this->_value;

        if (is_array($array)) {
            $temparray=$array;
        }

           return $this->_return(
               array_reverse($temparray)
           );
    }
    /**
     * Function randomize array
     *
     * @param mixed
     *
     * @return array
     */
    public function shuffle($array = null)
    {
        $tempArray=$this->_value;
        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter must be an array');
        } else {
            if ($array !=null && is_array($array)) {
                $tempArray=$array;
            }
        }
        $success=shuffle($tempArray);
 
        if ($success==false) {
            throw new Exception('Shuffle failed');
        }

        if ($this->_mutable == true) {
            $this->_value=$success;
        }

        return $success;

    }
    /**
     * Function end returns last element from array
     *
     * @param mixed
     *
     * @return mixed
     */
    public function end($array = null)
    {
        $tempArray=$this->_value;
        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter must be an array');
        } else {
            if ($array !=null && is_array($array)) {
                $tempArray=$array;
            }
        }
        return end($tempArray);
    }
    /**
     * Function shift element off the start of array
     *
     * @param mixed
     *
     * @return mixed
     */
    public function shift($array = null)
    {
        $tempArray=$this->_value;
        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter must be an array');
        } else {
            if ($array !=null && is_array($array)) {
                $tempArray=$array;
            }
        }
        $returnValue=array_shift($tempArray);

        if ($this->_mutable == true) {
            $this->_value=$tempArray;

        }
        return $returnValue;
   
    }
    /**
     * Function replace elements from passed array
     *
     * @param mixed
     *
     * @return array
     */
    public function replace($array)
    {

        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter must be an array');
        }
           return $this->_return(
               array_replace($this->_value, $array)
           );

    }

    /**
     * Function removes duplicate values from an array.
     *
     * @param mixed
     *
     * @return array
     */
    public function unique($array = null)
    {
        $temparray=$this->_value;

        if ($array !=null && !is_array($array)) {
            throw new Exception('Parameter 2 must be an array');
        } else {
            $temparray=$array;
        }

           return $this->_return(
               array_unique($temparray)
           );

    }
    /**
     * Function saves key value pair to array.
     *
     * @param mixed
     * @param mixed
     * @param mixed | optional
     *
     * @return bool
     */
    public function saveKey($key, $value, $array = null)
    {
        try {
            if ($array !=null && is_array($array)) {
                $array[$key]=$value;
                return true;
            }
            if ($this->_value == null) {
                   $this->_value =array();
            }
                 $this->_value[$key]=$value;
                 return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    /**
     * Function fetchs value by key.
     *
     * @param mixed
     * @param array | optional
     * @throws 'Array does not contain key'
     *
     * @return mixed
     */
    public function getKey($key, $array = null)
    {
        if (is_array($array)) {
            if ($this->hasKey($key, $array)==false) {
                throw new Exception('Array does not contain key');
            }
             return $array[$key];
        }
                return $this->_value[$key];

    }
    /**
     * Function checks if key exists returns a boolean.
     *
     * @param mixed
     *
     * @return bool
     *
     */
    public function hasKey($key, $array = null)
    {
        if ($array !=null && is_array($array)) {
             return array_key_exists($key, $array);

        }

            return array_key_exists($key, $this->_value);
    }

    /**
     * Function returns an array.
     *
     * @param array
     *
     * @return array
     *
     */
    private function _return($array)
    {

        if ($this->_mutable == true) {
            $this->_value=$array;

        }


        return $array;
    }
}
