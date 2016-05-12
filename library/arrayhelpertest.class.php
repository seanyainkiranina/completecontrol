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

require('arrayhelper.class.php');

class ArrayHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructAndGetAndSet()
    {
        $array=array(1,2,3,4,5,6,7,8,9,10);

        $ah = new ArrayHelper($array);

// Make sure we are not using by reference
        $this->assertEquals(10, $ah->pop());
        $this->assertEquals(10, $ah->pop());
     
// Make sure we are not using by reference
        $this->assertEquals(1, $ah->shift());
        $this->assertEquals(1, $ah->shift());
  
        $ah->setMutable(true);

        $this->assertEquals(1, $ah->shift());
        $this->assertEquals(2, $ah->shift());
        $ah->unshift(2, 1);
        $this->assertEquals(1, $ah->shift());


         


    }
}
