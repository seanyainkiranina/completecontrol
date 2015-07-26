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
class File extends stdClass
{
    private $_value = null;
    private $_objectid = '0715221e-59e8-9589-434093851da8';
    private $_mutable = false;
    private $_filemode = false;

    private $_isDir = false;
    private $_isExecutable = false;
    private $_isFile = false;
    private $_isLink = false;
    private $_isReadable = false;
    private $_isWriteable = false;
    private $_isUploadedFile = false;
    private $_exists = false;

    private $_basename = null;
    private $_dirname = null;
    private $_type = null;
    private $_owner = null;

    private $_atime = null;
    private $_ctime = null;
    private $_mtime = null;
    private $_size = null;


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
        $this->_init();
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
     * @return gmp
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
     * Function set sets the internal gmp.
     *
     *
     * @param mixed
     *
     * @return none
     */
    public function set($parameter)
    {
        $this->_value = $this->_toFile($parameter);
        $this->_init();
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
     * Function setReturnMode changes returns File object rather
     * then strings
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
        $this->_filemode = $mode;
    }
    /**
     * Function group returns file group owner as string or null 
     * 
     * @return mixed
     */
    public function group()
    {
        if ($this->_exists==false)
             return null;

        $groupid= filegroup($this->_value);

       if ($groupid === false)
          return null;

        $group=posix_getgrgid($groupid);

        if (!is_array($group))
             return null;

       return $group['name'];

    }
    /**
     * Function owner returns file owner as string or null 
     * 
     * @return mixed
     */
    public function owner()
    {
        if ($this->_exists==false)
             return null;

        $userid= fileowner($this->_value);

       if ($userid === false)
          return null;

        $user=posix_getpwuid($userid);

        if (!is_array($user))
             return null;

       return $user['name'];

    }
    /**
     * Function _init set all internal properties
     *
     * @param string 
     *
     *
     */
    private function _init()
    {
        $parameter=$this->_value;
        $this->_exists = file_exists($parameter);
        $this->_basename = basename($parameter);
        $this->_dirname = dirname($parameter);

        if ($this->_exists==true){

            $this->_isDir = is_dir($parameter);
            $this->_isExecutable = is_executable($parameter);
            $this->_isFile = is_file($parameter);
            $this->_isLink = is_link($parameter);
            $this->_isReadable = is_readable($parameter);
            $this->_isWriteable = is_writeable($parameter);
            $this->_isUploadedFile = is_uploaded_file($parameter);

            $this->_atime = fileatime($parameter);
            $this->_ctime = filectime($parameter);
            $this->_mtime = filemtime($parameter);
            $this->_size  = filesize($parameter);

            $this->_type = filetype($parameter);
            $this->_owner = fileowner($parameter);

           return;

        }
            $this->_isDir = false;
            $this->_isExecutable = false;
            $this->_isFile = false;
            $this->_isLink = false;
            $this->_isReadable = false;
            $this->_isWriteable = false;
            $this->_isUploadedFile = false;

            $this->_atime = null;
            $this->_ctime = null;
            $this->_mtime = null;
            $this->_size = null;
            $this->_type = null;
            $this->_owner = null;

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
        if ($this->_filemode == false) {
            return $parameter;
        }
        return new File($parameter);
    }
    /**
     * Function _toFile
     *
     * @param mixed
     *
     * @return float
     */
    private function _toFile($parameter)
    {
        if (is_file($parameter)) {
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
}
