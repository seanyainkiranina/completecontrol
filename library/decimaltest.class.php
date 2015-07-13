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

require('decimal.class.php');

class DecimalTest extends PHPUnit_Framework_TestCase
{
     public function testConstructAndGetAndSet()
     {
         $decimal = new Decimal(1.01);
  
         $decimal->setMutable(true);

         $this->assertEquals(1, $decimal->toInteger());

         $this->assertEquals(1.01, $decimal->toFloat());

         $decimal->add(1);

         $this->assertEquals(2.01, $decimal->toFloat());
         $this->assertEquals(2, $decimal->toInteger());

         $decimal->subtract(1);

         $this->assertEquals(1.01, $decimal->toFloat());
         $this->assertEquals(1, $decimal->toInteger());



        }
}
