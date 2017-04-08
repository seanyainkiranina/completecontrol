<?php
namespace completecontrol;

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
class ArrayHelper extends \stdClass
{

    private $value = 7;
    private $objectid = '0715221d-59e8-9689-434093851da8';
    private $mutable = false;
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
        $this->value = $param;
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
        return $this->value;
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
        $this->value = $parameter;
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
            throw new \Exception('Non boolean parameter');
        }

        $this->mutable = $mutable;
    }
    /**
     * Function instances itself from xml serialized version of the object.
     *
     * @return Decimal
     */
    public function fromSerial($serialObject)
    {

              return unserialize($serialObject);
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
               $returnvalue=arrayrand($this->value, $count);

               $this->value=$returnvalue;

               return $returnvalue[0];
        }

        return $this->returnArray(arrayrand($this->value, $count));
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
        $temparray=$this->value;
        if (is_array($array)) {
            $temparray=$array;
        }
        if ($size==null) {
            $size=intval(count($temparray)/2);
        }
        return $this->return(
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
            throw new \Exception('Key Required');
        }

        return $this->return(array_column($this->value, $key));
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
            throw new \Exception('Invalid Parameters');
        }

        return $this->return(array_combine($keyArray, $valueArray));
    }
    /**
     * Function counts the number of values and returns an array of counts of
     * values
     *
     * @return array
     */
    public function countValues()
    {
        return $this->return(array_count_values($this->value));
    }
    /**
     * Function create an array of sequence of indexes same value
     *
     * @return array
     */
    public function fill($startIndex, $endIndex, $value)
    {
        return $this->returnArray(
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
        $tempArray=$this->value;

        if (is_array($array)) {
            $tempArray=$array;
        }
        return $this->return(
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
        $tempArray=$this->value;
        if (is_array($array)) {
            $tempArray=$array;
        }
        if (!is_function($callback)) {
            throw new \Exception('Invalid Parameter');
        }

        return $this->return(
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
        $tempArray =$this->value;

        if (is_array($array)) {
            $tempArray =$array2;
        }

        if (!is_array($array)) {
            throw new \Exception('Invalid Parameter');
        }

        return $this->return(
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
            throw new \Exception('Invalid Parameter');
        }

        if ($search!=null && $array!=null) {
            return $this->returnArray(array_keys($array, $search));
        }
        if ($search==null && $array !=null) {
            return $this->returnArray(array_keys($array));
        }
        if ($search !=null && $array==null) {
            return $this->returnArray(array_keys($this->value, $search));
        }
            return $this->returnArray(array_keys($this->value));
    }
    /**
     * Function returns values of array
     *
     * @return array
     */
    public function values($search = null, $array = null)
    {
        if ($array!=null && !is_array($array)) {
            throw new \Exception('Invalid Parameter');
        }
        if ($array !=null && $search==null) {
            return $this->return(array_values($array));
        }
        if ($array !=null && $search !=null) {
            return $this->returnArray(
                array_values(
                    array_search($search, $array)
                )
            );
        }
        if ($search !=null) {
            return $this->return(
                array_values(
                    array_search($search, $this->value)
                )
            );
        }

            return $this->returnArray(array_values($this->value));
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
             return in_array($value, $this->value, true);
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

         return $this->returnArray(explode($deliminater, $string));

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
             return implode($deliminater, $this->value);
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

            return $this->returnArray(compact($values));
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
            throw new \Exception('Parameter 1 must be a function');
        }

        $temparray=$this->value;
        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter 2 must be an array');
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
        $temparray=$this->value;
        if (!is_function($callback)) {
            throw new \Exception('Invalid Parameter');
        }
        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter 2 must be an array');
        } else {
            $temparray=$array;
        }
            return $this->returnArray(array_map($callback, $temparray));
    }
    /**
     * Function push element on to the front of an array
     *
     * @param mixed
     *
     * @return mixed
     */
    public function unshift(...$values)
    {
        $temparray=$this->value;
        foreach ($values as $value) {
               array_unshift($temparray, $value);
        }

        if ($this->mutable == true) {
            $this->value = $temparray;
        }

        return $temparray;
    }
    /**
     * Function push element on to the end of array
     * if first argument is an array and ther are more then one parameter
     * remaining arguments are pushed to first argument
     *
     * @param mixed
     *
     * @return mixed
     */
    public function push(...$values)
    {
        $temparray=$this->value;

        if (count($values)>1) {
            if (is_array($values[0])) {
                $temparray=array_unshift($values);
            }
        }
        foreach ($values as $value) {
            $testcount=count($temparray);

            $testedcount=array_push($temparray, $value);

            if (($testcount+1) != $testedcount) {
                 throw new \Exception('Value could not be pushed');
            }
        }
        if ($this->mutable == true) {
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
        $tempArray=$this->value;

        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter must be an array');
        } else {
            if ($array !=null && is_array($array)) {
                $tempArray=$array;
            }
        }
        $returnValue=array_pop($tempArray);

        if ($this->mutable == true) {
            $this->value=$tempArray;
        }
        return $returnValue;
    }
    /**
     * Function sort returns a sorted array
     * sortflag 0 SORTREGULAR, 1 SORTNUMERIC, 2 SORTSTRING
     * 3 SORTLOCALESTRING,
     * 4 SORTNATURAL,
     * 5 SORTFLAGCASE
     * sortoptions 0 VALUE, 1 MAINTAINKEY, 2 SORTKEY
     *
     * @param int
     * @param mixed
     *
     * @return array
     */
    public function sort(
        $sortflag = 0,
        $sortoption = 0,
        $reverse = false,
        $array = null
    ) {
        $temparray=$this->value;
        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter must be an array');
        }
        if (is_array($array)) {
                $temparray=$array;
        }
        $whichSort="sort";
        switch ($sortoption) {
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
                throw new \Exception('Invaild sort option');
                break;
        }

        $success=false;
        switch ($sortflag) {
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
                throw new \Exception('Invaild sort flag');
                break;
        }
        if ($success==false) {
            throw new \Exception('Failed Sort');
        }

           return $this->returnArray($temparray);

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
        $temparray=$this->value;
        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter must be an array');
        }
        if (is_array($array)) {
            $temparray=$array;
        }
           return $this->return(
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
            throw new \Exception('Parameter must be an array');
        }
        $temparray=$this->value;

        if (is_array($array)) {
            $temparray=$array;
        }

           return $this->returnArray(
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
        $tempArray=$this->value;
        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter must be an array');
        } else {
            if ($array !=null && is_array($array)) {
                $tempArray=$array;
            }
        }
        $success=shuffle($tempArray);

        if ($success==false) {
            throw new \Exception('Shuffle failed');
        }

        if ($this->mutable == true) {
            $this->value=$success;
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
        $tempArray=$this->value;
        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter must be an array');
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
        $tempArray=$this->value;
        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter must be an array');
        } else {
            if ($array !=null && is_array($array)) {
                $tempArray=$array;
            }
        }
        $returnValue=array_shift($tempArray);

        if ($this->mutable == true) {
            $this->value=$tempArray;
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
            throw new \Exception('Parameter must be an array');
        }
           return $this->return(
               array_replace($this->value, $array)
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
        $temparray=$this->value;

        if ($array !=null && !is_array($array)) {
            throw new \Exception('Parameter 2 must be an array');
        } else {
            $temparray=$array;
        }

           return $this->return(
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
            if ($this->value == null) {
                   $this->value =array();
            }
                 $this->value[$key]=$value;
                 return true;
        } catch (\Exception $ex) {
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
                throw new \Exception('Array does not contain key');
            }
             return $array[$key];
        }
                return $this->value[$key];

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

            return array_key_exists($key, $this->value);
    }

    /**
     * Function returns an array.
     *
     * @param array
     *
     * @return array
     *
     */
    private function returnArray($array)
    {

        if ($this->mutable == true) {
            $this->value=$array;
        }


        return $array;
    }
}
