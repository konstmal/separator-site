<?php

class CommandLineTest extends TestCase
{

    public function testEmpty()
    {
        //First parameter is N, next parameters are elements of array
        Artisan::call('separate', ['number' => 1, 'array' => []]);

        // We need result of console output
        $result = Artisan::output();

        $this->assertEquals(intval($result), -1);
    }

    public function testFormulation()
    {
        //First parameter is N, next parameters are elements of array
        Artisan::call('separate', ['number' => 5, 'array' => [5, 5, 1, 7, 2, 3, 5]]);

        $result = Artisan::output();

        $this->assertEquals(intval($result), 4);
    }


}