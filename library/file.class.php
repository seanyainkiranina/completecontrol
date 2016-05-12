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
class File extends \stdClass
{
    private $value = null;
    private $objectid = '0715221e-59e8-9589-434093851da8';
    private $filemode = false;
    private $array = array();

    private $isDir = false;
    private $isExecutable = false;
    private $isFile = false;
    private $isLink = false;
    private $isReadable = false;
    private $isWriteable = false;
    private $isUploadedFile = false;
    private $exists = false;

    private $basename = null;
    private $dirname = null;
    private $type = null;
    private $owner = null;

    private $atime = null;
    private $ctime = null;
    private $mtime = null;
    private $size = null;


    private $savedsize =null;


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
        $this->value = $this->toFile($parameter);
        $this->init();
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
        return calluserfuncarray($method, $params);
    }
    /**
     * Readonly property test if directory
     *
     * @return bool
     */
    public function isDir()
    {
        $this->init();
          return $this->isDir;
    }
    /**
     * Readonly property test if executable
     *
     * @return bool
     */
    public function isExecutable()
    {
        $this->init();
         return $this->isExecutable;
    }
    /**
     * Readonly property test if readable
     *
     * @return bool
     */
    public function isReadable()
    {
        $this->init();
          return $this->isReadable;
    }
    /**
     * Readonly property test if writeable
     *
     * @return bool
     */
    public function isWriteable()
    {
        $this->init();
         return $this->isWriteable;
    }
    /**
     * Readonly property test if uploadedfile
     *
     * @return bool
     */
    public function isUploadedFile()
    {
        $this->init();
        return $this->isUploadedFile;
    }
    /**
     * Readonly property file size
     *
     * @return int
     */
    public function size()
    {
        $this->init();
        return $this->size;
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
        return $this->value;
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
        $this->value = $this->toFile($parameter);
        $this->init();
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
            throw new \Exception('Non boolean parameter');
        }
        $this->filemode = $mode;
    }
    /**
     * Function isFile returns true if file exists
     * @return bool
     */
    public function isFile()
    {
        return $this->isFile;
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
        if ($this->value==null) {
            throw new \Exception("Cannot determine file name");
        }

        if ($this->exists==false) {
            throw new \Exception("File does not exist");
        }

        if ($this->isReadable==false) {
            throw new \Exception("File is not readable");
        }

        return file($this->value);

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
        if ($this->value==null) {
            throw new \Exception("Cannot determine file name");
        }

        if ($time==null) {
            return touch($this->value);
        }

        if ($atime==null) {
            return touch($this->value, $time);
        }

        return touch($this->value, $time, $atime);
    }
    /**
     * Function diskfreespace
     *
     * @throws mixed
     *
     * @return float
     */
    public function diskfreespace()
    {
        if ($this->dirname == null) {
            throw new \Exception("Cannot determine directory");
        }


        return diskfreespace($this->dirname);

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
        if ($this->exists==false) {
            throw new \Exception("File does not exist");
        }
        if ($this->isReadable==false) {
            throw new \Exception("File is not readable");
        }
        if ($this->isWriteable==false) {
            throw new \Exception("File is not writeable");
        }

        if (!unlink($this->value)) {
            throw new \Exception("File could not be deleted");
        }

        $this->init();

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
        if ($this->exists==false) {
            throw new \Exception("File does not exist");
        }

        if ($this->isReadable==false) {
            throw new \Exception("File is not readable");
        }

        if (!copy($this->value, $target)) {
            throw new \Exception("File could not be copied");
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
        if ($this->exists==false) {
            throw new \Exception("File does not exist");
        }
        
        if ($this->isReadable==false) {
            throw new \Exception("File is not readable");
        }

        $groupid= filegroup($this->value);

        if ($groupid === false) {
            throw new \Exception("Error getting group id");
        }

        $group=posixgetgrgid($groupid);

        if (!isarray($group)) {
            throw new \Exception("Error getting group id");
        }

        if ($newgroup==null) {
            return $group['name'];
        }

        if ($this->isWriteable == false) {
            throw new \Exception("File is not writeable");
        }

        if (chgrp($this->value, $newgroup)===false) {
            throw new \Exception("Unable to change File group");
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
        if ($this->exists==false) {
            throw new \Exception("File does not exist");
        }
        
        if ($this->isReadable==false) {
            throw new \Exception("File is not readable");
        }

        $userid= fileowner($this->value);

        if ($userid === false) {
            throw new \Exception("Could not get file owner");
        }

        $user=posix_getpwuid($userid);

        if (!is_array($user)) {
            throw new \Exception("Could not get file owner");
        }

        if ($newowner == null) {
             return $user['name'];
        }

        if ($this->isWriteable == false) {
            throw new \Exception("File is not writeable");
        }

        if (chown($this->value, $newowner)===false) {
            throw new \Exception("Could not set file owner");
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
        if ($this->exists==false) {
            throw new \Exception("File does not exist");
        }

        if ($this->isReadable==false) {
            throw new \Exception("File is not readable");
        }

        return file_get_contents($this->value);

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
        return file_put_contents($this->value, $content);

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
        $fp = fopen($this->value, "a+");

        if (flock($fp, LOCK_EX)===false) {
            throw new \Exception("Unable to lock file");
        }
            fwrite($fp, $text);

            fflush($fp);

            flock($fp, LOCK_UN);

            fclose($fp);

           $this->init();

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

        if ($this->exists==false) {
            throw new \Exception("File does not exist");
        }

        if ($this->isWriteable == false) {
            throw new \Exception("File is not writeable");
        }

        $validmode=false;

        if ($mode>777) {
            throw new \Exception("Bad file mode");
        }

        if ($mode<0) {
            throw new \Exception("Bad file mode");
        }

        $characters=strsplit($mode);

        foreach ($characters as $character) {
            if (intval($character)>7) {
                throw new \Exception("Bad file mode");
            }
        }

        return chmod($this->value, $mode);

    }
    /**
     * Function lines factory to loop through a file
     *
     * @return string
     */
    public function &lines()
    {
        if ($this->value==null) {
            throw new \Exception("Bad file mode");
        }
       
        if ($this->isReadable ==false) {
            throw new \Exception("File is not readable");
        }
     
        $this->init();

        if ($this->savedsize != $this->size) {
            $this->array = file($this->value);
            $this->init();
            $this->savedsize = $this->size;
        }

        foreach ($this->array as $line) {
            yield $line;
        }


    }

    /**
     * Function init set all internal properties
     *
     * @param string
     *
     *
     */
    private function init()
    {
        $parameter=$this->value;
        $this->exists = file_exists($parameter);
        $this->basename = basename($parameter);
        $this->dirname = dirname($parameter);

        if ($this->exists==true) {
            $this->isDir = is_dir($parameter);
            $this->isExecutable = is_executable($parameter);
            $this->isFile = is_file($parameter);
            $this->isLink = is_link($parameter);
            $this->isReadable = is_readable($parameter);
            $this->isWriteable = is_writeable($parameter);
            $this->isUploadedFile = is_uploaded_file($parameter);

            $this->atime = fileatime($parameter);
            $this->ctime = filectime($parameter);
            $this->mtime = filemtime($parameter);
            $this->size  = filesize($parameter);

            $this->type = filetype($parameter);
            $this->owner = fileowner($parameter);

            return;
        }
            $this->isDir = false;
            $this->isExecutable = false;
            $this->isFile = false;
            $this->isLink = false;
            $this->isReadable = false;
            $this->isWriteable = false;
            $this->isUploadedFile = false;

            $this->atime = null;
            $this->ctime = null;
            $this->mtime = null;
            $this->size = null;
            $this->type = null;
            $this->owner = null;

    }
    /**
     * Function return
     *
     * @param float
     *
     * @return mixed
     */
    private function returnFile($parameter)
    {
        if ($this->filemode == false) {
            return $parameter;
        }
        return new File($parameter);
    }
    /**
     * Function toFile
     *
     * @param mixed
     *
     * @return float
     */
    private function toFile($parameter)
    {
        if (is_file($parameter)) {
            return $parameter;
        }
        
        if (is_object($parameter)) {
            if (method_exists($parameter, "getObjectID")) {
                if ($this->objectid == $parameter->getObjectID()) {
                    return $parameter->get();
                }
            }
        }
        if (is_string($parameter)) {
            return $parameter;
        }

        throw new \Exception('Invalid Parameter');
    }
}
