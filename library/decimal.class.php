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
class Decimal extends \stdClass
{
    private $value = null;
    private $objectid = '0715221d-59e8-9589-434093851da8';
    private $mutable = false;
    private $decimalmode = false;
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
     * Function overload to create dynamic function
     *
     * @param array
     *
     * @return mixed
     */
    public function __call($function, $params)
    {
        $method = $this->$function->bindto($this);
        return calluserfuncarray($method, $params);
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
        $this->value = $this->toNumber($parameter);
    }
    /**
     * Function setMutable sets changablity of the internal string.
     * Setting to TRUE causes each function to call its internal string
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
            throw new \Exception('Non boolean parameter');
        }
        
        $this->decimalmode = $mode;
    }
    /**
     * Function return
     *
     * @param float
     *
     * @return mixed
     */
    private function returnDecimal($parameter)
    {
        if ($this->mutable === true) {
            $this->value = $parameter;
        }
        

        if ($this->decimalmode === false) {
            return $parameter;
        }
        
        
        return new Decimal($parameter);
    }
    /**
     * Function toNumber
     *
     * @param mixed
     *
     * @return integer
     */
    private function toNumber($parameter)
    {
        if (is_numeric($parameter)) {
            return $parameter;
        }
        
        if (is_object($parameter)) {
            if (method_exists($parameter, "getObjectID")) {
                if ($this->objectid == $parameter->getObjectID()) {
                    return $parameter->get();
                }
            }
        }
                
            
        
        throw new \Exception('Invalid Parameter');
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
        if ($this->value != null) {
            $returnValue = $this->value;
        }
        
        foreach ($parameters as $parameter) {
            $returnValue = $returnValue + $this->toNumber($parameter);
        }
        
        
        return $this->returnDecimal($returnValue);
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
        if ($this->value != null) {
            $returnValue = $this->value;
        } else {
            $returnValue = $this->toNumber(array_shift($parameters));
        }
        foreach ($parameters as $parameter) {
            $returnValue = $returnValue - $this->toNumber($parameter);
        }
        
        return $this->returnDecimal($returnValue);
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
        if ($this->value != null) {
            $returnValue = $this->value;
        } else {
            $returnValue = $this->toNumber(array_shift($parameters));
        }
        foreach ($parameters as $parameter) {
            $returnValue = $returnValue * $this->toNumber($parameter);
        }
        

        return $this->returnDecimal($returnValue);
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
            throw new \Exception("Invalid parameters");
        }
        
        $returnValue = 0;
        if ($this->value != null) {
            $returnValue = $this->value;
        } else {
            $returnValue = $this->toNumber(array_shift($parameters));
        }
        foreach ($parameters as $parameter) {
            $returnValue = $returnValue / $this->toNumber($parameter);
        }
        
        return $this->returnDecimal($returnValue);
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
        if ($this->value == null) {
            throw new \Exception("Invalid base");
        }
        
        if ($parameter == null) {
            throw new \Exception("Invalid exponential");
        }
        

        return $this->returnDecimal(
            pow($this->value, $this->toNumber($parameter))
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
            if ($this->value == null) {
                throw new \Exception("Parameter missing");
            }
        }
            
        
        if ($parameter == null) {
                return $this->returnDecimal(
                    abs($this->value)
                );
        }
            
        return $this->returnDecimal(
            abs($this->toNumber($parameter))
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
            if ($this->value == null) {
                throw new \Exception("Parameter missing");
            }
        }
            
        
        if ($parameter == null) {
              return $this->returnDecimal(
                  round($this->value, $precision)
              );
        }

              return $this->returnDecimal(
                  round($parameter, $precision)
              );
    }
}
