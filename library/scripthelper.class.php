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
class ScriptHelper extends stdClass
{
    private $value = null;
    private $objectid = '0915223e-59e8-9689-434093851da8';

    private $runswap = null;
    private $rumajflt = null;
    private $ruutime = null;
    private $microtime =null;

    private static $object =null;

    /**
     * Function constructor
     *
     *
     * @return instance
     */
    public function __construct()
    {
              $this->usage();
              $this->microtime=microtime();
    }
    public function destruct()
    {
              $this->usage();
              $this->microtime=microtime();

    }

    public function __set($name,$value)
    {

            if (is_object($value))
            {
              $this->$name=$value;
            }

            if (class_exists($name))
            {
              if (is_null($value)){
                 $this->$name = new $name();
               }
                else{
                  $this->$name = new $name($value);
               }
            }


            $this->$name=$value;

    }
    /**
     * Accessor to swap on unset reloads the data.
     */
    public function __get($name)
    {
        switch ($name) {
            case "swap":
                return $this->runswap;
            case "majflt":
                return $this->rumajflt;
            case "utime":
                return $this->ruutime;
            case "microtime":
                return $this->microtime;
            case "duplicate":
                return $this;
        }
        if (isset($this->name)){
             return $this->name;
        }
        throw new \Exception('Invalid property');
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
    public function call($function, $params)
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
    private function usage()
    {
         $data = getrusage();
         $this->runswap = $data['runswap'];
         $this->rumajflt = $data['rumajflt'];
         $this->ruutime = $data['ruutime.tvsec'];

    }

    static function instance(){

        if (is_null(self::$object)){

          self::$object= new get_class($this);


        }

         return self::$object;

    }
}
