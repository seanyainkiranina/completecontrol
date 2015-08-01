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

         $this->assertEquals(1.01, $decimal->get());

         $decimal->set(10);

         $this->assertEquals(10, $decimal->get());

         $decimal2 = new Decimal(2);

         $this->assertEquals(2, $decimal2->get());

         $decimal->set($decimal2);

         $this->assertEquals(2, $decimal->get());


        }
        public function testAdd()
        {

            $decimal = new Decimal(3);

            $this->assertEquals(33, $decimal->add(10, 10, 10));

            $this->assertEquals(3, $decimal->get());

            $decimal->setMutable(true);

            $this->assertEquals(33, $decimal->add(10, 10, 10));

            $this->assertEquals(33, $decimal->get());

            $decimal2 = new Decimal(3);

            $this->assertEquals(56, $decimal->add($decimal2, 10, 10));


        }
        public function testSubtract()
        {
            $decimal = new Decimal(3);

            $this->assertEquals(-27, $decimal->subtract(10, 10, 10));

            $decimal2 = new Decimal(3);

            $this->assertEquals(0, $decimal->subtract($decimal2));

        }
        public function testPowerAndDivide()
        {

            $decimal = new Decimal(3);

            $this->assertEquals(27, $decimal->power(3));

            $this->assertEquals(1, $decimal->divide(3));

            $decimal->setMutable(true);

            $this->assertEquals(27, $decimal->power(3));

            $this->assertEquals(3, $decimal->divide(3, 3));

            $decimal2 = new Decimal(3);

            $this->assertEquals(27, $decimal->power($decimal2));


        }
        public function testRand()
        {

            $x=rand(-100000, 100000);
            $y=rand(-100000, 100000);

            $decimal = new Decimal();

            $this->assertEquals(($x/$y), $decimal->divide($x, $y));
            $this->assertEquals(($x*$y), $decimal->multiply($x, $y));

            $decimal->setReturnMode(true);

            $this->assertEquals(
                (($x*$x)/$y),
                $decimal->divide($decimal->multiply($x, $x), $y)->get()
            );


        }
}
