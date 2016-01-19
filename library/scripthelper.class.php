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
class ScriptHelper extends stdClass
{
    private $_value = null;
    private $_objectid = '0915223e-59e8-9689-434093851da8';

    private $_ru_nswap = null;
    private $_ru_majflt = null;
    private $_ru_utime = null;
    private $_microtime =null;



    /**
     * Function constructor
     *
     *
     * @return instance
     */
    public function __construct()
    {
              $this->_usage();
              $this->_microtime=microtime();
    }
    public function __destruct()
    {
              $this->_usage();
              $this->_microtime=microtime();

    }
    /**
     * Accessor to swap on unset reloads the data.
     */
    public function __get($name)
    {
        switch($name){
            case "swap":
                return $this->_ru_nswap;
            case "majflt":
                return $this->_ru_majflt;
            case "utime":
                return $this->_ru_utime;
            case "microtime":
                return $this->_microtime;
            case "duplicate":
                return $this;
        }
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
     * Function collect cycles
     *
     */
    public function collect()
    {
           gc_collect_cycles();
    }
    /**
     * Function disable gc collect
     *
     */
    public function disable()
    {
           gc_disable();
    }
    /**
     * Function enable gc collect
     *
     */
    public function enable()
    {
           gc_enable();
    }
    /**
     * Private function get usage sets internal variables
     *
     * @return nothing
     */
    private function _usage()
    {
         $data = getrusage();
         print_r($data);
         $this->_ru_nswap = $data['ru_nswap'];
         $this->_ru_majflt = $data['ru_majflt'];
         $this->_ru_utime = $data['ru_utime.tv_sec'];
        
    }
}
