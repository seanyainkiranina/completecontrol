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
    private $_value = null;
    private $_objectid = '0715221d-59e8-9589-434093851da8';
    private $_mutable = false;
    private $_decimalmode = false;
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
        $this->_value = $this->_toNumber($parameter);
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
     * Function setReturnMode changes returns to decimal objects rather
     * then numeric
     *
     * @param bool
     *
     * @return none
     */
    public function setReturnMode($mode)
    {
        if (!is_bool($mode)) {
            throw new Exception('Non boolean parameter');
        }
        
        $this->_decimalmode = $mode;
    }
    /**
     * Function _return
     *
     * @param float
     *
     * @return mixed
     */
    private function _return($parameter)
    {
        if ($this->_mutable == true) {
            $this->_value = $parameter;
        }
        

        if ($this->_decimalmode == false) {
            return $parameter;
        }
        
        
        return new Decimal($parameter);
    }
    /**
     * Function _toNumber
     *
     * @param mixed
     *
     * @return float
     */
    private function _toNumber($parameter)
    {
        if (is_numeric($parameter)) {
            return $parameter;
        }
        
        if (is_object($parameter)) {
            if (method_exists($parameter, "getObjectID")) {
                if ($this->_objectid == $parameter->getObjectID()) {
                    return $parameter->get();
                }
            }
        }
                
            
        
        throw new Exception('Invalid Parameter');
    }
    /**
     * Function add
     *
     * @param mixed
     *
     * @return float
     */
    public function add(...$parameters)
    {
        $returnValue = 0;
        if ($this->_value != null) {
            $returnValue = $this->_value;
        }
        
        foreach ($parameters as $parameter) {
            $returnValue = $returnValue + $this->_toNumber($parameter);
        }
        
        
        return $this->_return($returnValue);
    }
    /**
     * Function subtract
     *
     *
     * @param mixed
     *
     * @return float
     */
    public function subtract(...$parameters)
    {
        $returnValue = 0;
        if ($this->_value != null) {
            $returnValue = $this->_value;
        } else {
            $returnValue = $this->_toNumber(array_shift($parameters));
        }
        foreach ($parameters as $parameter) {
            $returnValue = $returnValue - $this->_toNumber($parameter);
        }
        
        return $this->_return($returnValue);
    }
    /**
     * Function multiply
     *
     *
     * @param mixed
     *
     * @return float
     */
    public function multiply(...$parameters)
    {
        $returnValue = 0;
        if ($this->_value != null) {
            $returnValue = $this->_value;
        } else {
            $returnValue = $this->_toNumber(array_shift($parameters));
        }
        foreach ($parameters as $parameter) {
            $returnValue = $returnValue * $this->_toNumber($parameter);
        }
        

        return $this->_return($returnValue);
    }
    /**
     * Function  for divison
     *
     *
     * @param mixed
     *
     * @return float
     */
    public function divide(...$parameters)
    {
        if (count($parameters) == 0) {
            throw new Exception("Invalid parameters");
        }
        
        $returnValue = 0;
        if ($this->_value != null) {
            $returnValue = $this->_value;
        } else {
            $returnValue = $this->_toNumber(array_shift($parameters));
        }
        foreach ($parameters as $parameter) {
            $returnValue = $returnValue / $this->_toNumber($parameter);
        }
        
        return $this->_return($returnValue);
    }
    /**
     * Function raise to the power of parameter
     *
     * @param mixed
     *
     * @return float
     */
    public function power($parameter)
    {
        if ($this->_value == null) {
            throw new Exception("Invalid base");
        }
        
        if ($parameter == null) {
            throw new Exception("Invalid exponential");
        }
        

        return $this->_return(
            pow($this->_value, $this->_toNumber($parameter))
        );
    }
    /**
     * Function returns absolute value of parameter of if null sets interal
     * variable to its absolute value.
     *
     * @param integer
     */
    public function abs($parameter = null)
    {
        if ($parameter == null) {
            if ($this->_value == null) {
                throw new Exception("Parameter missing");
            }
        }
            
        
        if ($parameter == null) {
                return $this->_return(
                    abs($this->_value)
                );
        }
            
        return $this->_return(
            abs($this->_toNumber($parameter))
        );
    }
    /**
     * Function round
     *
     * @param integer
     * @param mixed
     */
    public function round($precision = 0, $parameter = null)
    {
        if ($parameter == null) {
            if ($this->_value == null) {
                throw new Exception("Parameter missing");
            }
        }
            
        
        if ($parameter == null) {
              return $this->_return(
                  round($this->_value, $precision)
              );
        }

              return $this->_return(
                  round($parameter, $precision)
              );
    }
}
