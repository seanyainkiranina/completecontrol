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

require('file.class.php');

class FileTest extends PHPUnit_Framework_TestCase
{
     public function testConstructAndGetAndSet()
     {

         $file= new File('/etc/passwd');

         $this->assertEquals('root', $file->owner());
     

      }
     public function testWrite()
     {
        $file = new File('/tmp/test');

        $this->assertEquals(true,$file->append('test'));
        $this->assertEquals(true,$file->copy('/tmp/test2'));
        $this->assertEquals(true,$file->delete());

        $file = new File('/tmp/test2');

       $array=$file->toArray();
       $this->assertEquals(1,count($array));
       $this->assertEquals(true,$file->delete());
     
     }


}

