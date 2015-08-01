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
    public function __construct($parameter = null)
    {
        $this->_value = $this->_toFile($parameter);
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
     * Readonly property test if directory
     *
     * @return bool
     */
    public function isDir()
    {
        $this->_init();
          return $this->_isDir;
    }
    /**
     * Readonly property test if executable
     *
     * @return bool
     */
    public function isExecutable()
    {
        $this->_init();
         return $this->_isExecutable;
    }
    /**
     * Readonly property test if readable
     *
     * @return bool
     */
    public function isReadable()
    {
        $this->_init();
          return $this->_isReadable;
    }
    /**
     * Readonly property test if writeable
     *
     * @return bool
     */
    public function isWriteable()
    {
        $this->_init();
         return $this->_isWriteable;
    }
    /**
     * Readonly property test if uploadedfile
     *
     * @return bool
     */
    public function isUploadedFile()
    {
        $this->_init();
        return $this->_isUploadedFile;
    }
    /**
     * Readonly property file size
     *
     * @return int
     */
    public function size()
    {
        $this->_init();
        return $this->_size;
    }
    /**
     * Function get
     *
     * @return string
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
     * Function set sets the internal string.
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
     * Function isFile returns true if file exists
     * @return bool
     */
    public function isFile()
    {
        return $this->_isFile;
    }
    /**
     * Function toArray return array of file
     *
     * @throws mixed
     * @return array
     *
     */
    public function toArray()
    {
        if ($this->_value==null) {
            throw new Exception("Cannot determine file name");
        }

        if ($this->_exists==false) {
            throw new Exception("File does not exist");
        }

        if ($this->_isReadable==false) {
            throw new Exception("File is not readable");
        }

        return file($this->_value);

    }
    /**
     * Function instances itself from xml serialized version of the object.
     *
     * @return File
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
     * Function touch
     *
     * @param time
     * @param time
     * @throws mixed
     *
     * @return boolean
     */
    public function touch($time = null, $atime = null)
    {
        if ($this->_value==null) {
            throw new Exception("Cannot determine file name");
        }

        if ($time==null) {
            return touch($this->_value);
        }

        if ($atime==null) {
            return touch($this->_value, $time);
        }

        return touch($this->_value, $time, $atime);
    }
    /**
     * Function disk_free_space
     *
     * @throws mixed
     *
     * @return float
     */
    public function disk_free_space()
    {
        if ($this->_dirname == null) {
            throw new Exception("Cannot determine directory");
        }


        return disk_free_space($this->_dirname);

    }
    /**
     * Function delete
     *
     * @throws mixed
     *
     * @return bool
     *
     */
    public function delete()
    {
        if ($this->_exists==false) {
            throw new Exception("File does not exist");
        }
        if ($this->_isReadable==false) {
            throw new Exception("File is not readable");
        }
        if ($this->_isWriteable==false) {
            throw new Exception("File is not writeable");
        }

        if (!unlink($this->_value)) {
            throw new Exception("File could not be deleted");
        }

        $this->_init();

        return true;

    }
    /**
     * Function copy
     *
     * @param string
     * @throws mixed
     *
     * @return bool
     */
    public function copy($target)
    {
        if ($this->_exists==false) {
            throw new Exception("File does not exist");
        }

        if ($this->_isReadable==false) {
            throw new Exception("File is not readable");
        }

        if (!copy($this->_value, $target)) {
            throw new Exception("File could not be copied");
        }

        return true;

    }

    /**
     * Function group returns file group owner as string or null
     * on failure
     *
     * @param mixed
     * @throws mixed
     *
     * @return string
     */
    public function group($newgroup = null)
    {
        if ($this->_exists==false) {
            throw new Exception("File does not exist");
        }
        
        if ($this->_isReadable==false) {
            throw new Exception("File is not readable");
        }

        $groupid= filegroup($this->_value);

        if ($groupid === false) {
            throw new Exception("Error getting group id");
        }

        $group=posix_getgrgid($groupid);

        if (!is_array($group)) {
            throw new Exception("Error getting group id");
        }

        if ($newgroup==null) {
            return $group['name'];
        }

        if ($this->_isWriteable == false) {
            throw new Exception("File is not writeable");
        }

        if (chgrp($this->_value, $newgroup)===false) {
            throw new Exception("Unable to change File group");
        }

        clearstatcache();

        return $this->group();

    }
    /**
     * Function owner returns file owner as string or null
     *
     * @throws mixed
     *
     * @return string
     */
    public function owner($newowner = null)
    {
        if ($this->_exists==false) {
            throw new Exception("File does not exist");
        }
        
        if ($this->_isReadable==false) {
            throw new Exception("File is not readable");
        }

        $userid= fileowner($this->_value);

        if ($userid === false) {
            throw new Exception("Could not get file owner");
        }

        $user=posix_getpwuid($userid);

        if (!is_array($user)) {
            throw new Exception("Could not get file owner");
        }

        if ($newowner == null) {
             return $user['name'];
        }

        if ($this->_isWriteable == false) {
            throw new Exception("File is not writeable");
        }

        if (chown($this->_value, $newowner)===false) {
            throw new Exception("Could not set file owner");
        }

        clearstatcache();

        return $this->owner();
    }
    /**
     * Function toString converts file to string
     *
     *
     * @throws mixed
     *
     * @return string
     */
    public function toString()
    {
        if ($this->_exists==false) {
            throw new Exception("File does not exist");
        }

        if ($this->_isReadable==false) {
            throw new Exception("File is not readable");
        }

        return file_get_contents($this->_value);

    }
    /**
     * Function putString
     *
     *
     * @param string
     * @throws mixed
     *
     * @return bool
     */
    public function putString($content)
    {
        return file_put_contents($this->_value, $content);

    }
    /**
     * Function append
     *
     *
     * @param string
     * @throws mixed
     *
     * @return bool
     */
    public function append($text)
    {
        $fp = fopen($this->_value, "a+");

        if (flock($fp, LOCK_EX)===false) {
            throw new Exception("Unable to lock file");
        }


            fwrite($fp, $text);

            fflush($fp);

            flock($fp, LOCK_UN);

            fclose($fp);

           $this->_init();

           return true;
    }
    /**
     * Function chmod
     *
     * @param int
     *
     */
    public function chmod($mode)
    {

        $mode=intval($mode);

        if ($this->_exists==false) {
            throw new Exception("File does not exist");
        }

        if ($this->_isWriteable == false) {
            throw new Exception("File is not writeable");
        }

        $valid_mode=false;

        if ($mode>777) {
            throw new Exception("Bad file mode");
        }

        if ($mode<0) {
            throw new Exception("Bad file mode");
        }

        $characters=str_split($mode);

        foreach ($characters as $character) {
            if (intval($character)>7) {
                throw new Exception("Bad file mode");
            }
        }

        return chmod($this->_value, $mode);

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

        if ($this->_exists==true) {
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
        if (is_string($parameter)) {
            return $parameter;
        }

        throw new Exception('Invalid Parameter');
    }
}
