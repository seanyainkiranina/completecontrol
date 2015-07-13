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

class Decimal extends stdClass
{

     private $_integer = 0;
     private $_remainder = 0.0;
     private $_mutable = false;
     private $_objectid = '0715221d-59e8-9589-434093851da8';

     /**
      * Function constructor
      *
      * @return instance
      *
      * @param mixed
      */
        public function __construct($param = null)
        {
          list($this->_integer,$this->_remainder)=
               $this->_splitByDecimal($param);
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
      * @return gmp
      *
      * @throw 'Empty string'
      *
      * @param null
      */
        public function get()
        {

            return array($this->_integer,$this->_remainder);

        }
     /**
      * Function get-remainder
      *
      * @return mixed
      *
      * @param  none
      */
        public function get_remainder()
        {

            return $this->_remainder;

        }

     /**
      * Function set sets the internal gmp.
      *
      * @return none
      *
      * @paramter mixed
      */
        public function set($parameter)
        {
            list($this->_integer,$this->_remainder)=$this->_splitByDecimal($parameter);

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
      * Function add
      *
      * @return mixed
      *
      * @parameter
      */
        public function add($parameter)
        {
            list($gmp,$remainder)=$this->_splitByDecimal($parameter);

            $value =gmp_add($this->_integer, $gmp);

            $remain = $this->_remainder + $remainder;

            $remain_round = intval($this->_remainder);

            $remain = $remain - $remain_round;
         
            $remain_round = gmp_init($remain_round);

            $value = gmp_add($value, $remain_round);
        
            if ($this->_mutable==true) {
                $this->_integer = $value;
                $this->_remainder = $remain;
            }


            return $this->toFloat($value, $remain);

        }

     /**
      * Function substract
      *
      * @return mixed
      *
      * @parameter mixed
      */
        public function subtract($parameter)
        {
            list($gmp,$remainder)=$this->_splitByDecimal($parameter);

            $value =gmp_sub($this->_integer, $gmp);
            $remain = $this->_remainder - $remainder;

            if ($remain<0) {
                 $value =gmp_sub($this->_integer, gmp_init(1));
                 $remain = 1 + $remain;
            }

            if ($this->_mutable==true) {
                $this->_integer = $value;
                $this->_remainder = $remain;
            }

            return $this->toFloat($value, $remain);
        }


     /**
      * Function multiply
      *
      * @return
      *
      * @param mixed | integer 
      */
        public function multiply($parameter)
        {




           

        }

     /**
      * Function
      *
      * @return
      *
      * @param
      */
        public function divide($param)
        {


        }

     /**
      * Function
      *
      * @return
      *
      * @param integer
      */
        public function power($param)
        {

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

            $internal_int=gmp_intval($this->_integer);

            $check_string=(string)$internal_int;

            $check_integer=gmp_strval($this->_integer);

            if ($check_integer != $check_string) {
                throw new Exception('Decimal Can not be returned as int');
            }
                

            return $internal_int;

        }

     /**
      * Function
      *
      * @return
      *
      * @param integer remainder
      *
      */
        public function toFloat($integer =null, $remainder=null)
        {

           if ($integer==null)
              if ($remainder==null)
                  {
                      $return_value=gmp_strval($this->_integer);
                      $return_value_remainder=ltrim((string)$this->_remainder,'0');
                      $return_value .=$return_value_remainder;

                      
                      return $return_value;

                  }

            $return_value=gmp_strval($integer);
            $return_value_remainder=ltrim((string)$remainder,'0');
            $return_value .=(string)$return_value_remainder;
             
            $flt=(double)$return_value;

            $flt_str=(string)$flt;

            if ($flt_str==$return_value) {
                return $flt;

            }

            return $return_value;

        }

     /**
      * Function  _splitByDecimal splits string by decimal point into two tuples
      *
      * @return array
      *
      * @param mixed
      */
         private function _splitByDecimal($parameter)
         {
            if (is_object($parameter)) {
                if (method_exists($parameter, "getObjectID")) {
                    if ($this->_objectid == $parameter->getObjectID()) {
                               return $parameter->get();
                    }
                }
            }

            if (is_object($parameter)) {
                throw new Exception('Decimal Parameter Error');
            }


            if ($parameter == null) {
                 return array(null,null);
            }

            $str_version=(string)$parameter;

            $tuples=explode(".", $str_version);

            $integer=$tuples[0];

            $remainder=.0;

            if (isset($tuples[1])) {
                $remainder=(double) ("." . $tuples[1]);
            }

            return array($integer,$remainder);

         }
        
     /**
      * Function  _toDecimal polymorphic
      *
      * @return string
      *
      * @param Decimal object | string | integer | null
      */
            private function _toDecimal($parameter)
            {

                if (is_string($parameter)) {
                    if (!is_numeric($parameter)) {
                        throw new Exception('Decimal Parameter Error');
                    }
                    return gmp_init($parameter);
                }

                if (is_int($parameter)) {
                    return gmp_init($parameter);
                }

                if (is_numeric($paramter)) {
                    return gmp_init($parameter);
                }

                throw new Exception('Decimal Parameter Error');

            }

}
