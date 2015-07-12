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

require('string.class.php');

class StringTest extends PHPUnit_Framework_TestCase
{
     public function testConstructAndGetAndSet()
     {
         $string = new String("Test");

         $this->assertEquals("Test", $string->get());

         $string->set("Test2");

         $this->assertEquals("Test2", $string->get());

        }

        public function testConcat()
        {

            $string = new String("Test3");
       
            $string->concat(" Test4");

            $this->assertEquals("Test3 Test4", $string->concat(" Test4"));


        }

        public function testContains()
        {

            $string = new String("Test5");


            $this->assertTrue($string->contains("e"));

            $this->assertFalse($string->contains("X"));

            $this->assertTrue($string->contains("E", true));

            $this->assertFalse($string->contains("E", false));


        }
        public function testUc()
        {
            $string = new String("Test6");

            $this->assertEquals("TEST6", $string->uc());


        }
        public function testStrstr()
        {
            $string = new String("Test7");

            $this->assertEquals("st7", $string->strstr("s"));

            $this->assertEquals("Te", $string->strstr("s", true));

        }
        public function testSubstr()
        {
             $string = new String("Test8");

            $this->assertEquals("est8", $string->substr(1));

            $this->assertEquals("Te", $string->substr(0, 2));

        }
        public function testShuffle()
        {
             $string = new String("Test9");

            $this->assertNotEmpty($string->shuffle());


        }
        public function testReverse()
        {

             $string = new String("Test10");
            $this->assertEquals("01tseT", $string->reverse());

        }
        public function testReplace()
        {
             $string = new String("Test11");
            $this->assertEquals("Test12", $string->replace("11", "12"));
             $string = new String("Test11");
            $this->assertEquals("fest11", $string->replace("test", "fest", null, true));
        }
        public function testLength()
        {
             $string = new String("Test12");
            $this->assertEquals(6, $string->length());


        }
        public function testWordCount()
        {
             $string = new String("Test Test");
            $this->assertEquals(2, $string->wordCount());
  
        }
        public function testTrim()
        {
             $string = new String("Test13 ");
            $this->assertEquals("Test13", $string->trim());

        }
        public function testSplit()
        {
            $string = new String("Test14 Test14");

            $this->assertCount(2, $string->split(' '));
            $this->assertCount(13, $string->split());
        }
        public function testDynamic()
        {
            $string = new String("Test14 Test14");

            $string->x=1;

            $string->y=function ($xxx) {

                $xx=$this->x + $xxx;

                return $xx;

            };


            $this->assertEquals(1, $string->x);

            $this->assertEquals(2, $string->y(1));


        }
}
