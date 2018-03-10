<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Artisan;

class CommandLineTest extends TestCase
{

    public function testEmpty()
    {
        //First parameter is N, next parameters are elements of array
        Artisan::call('separate', [1]);

        // We need result of console output
        $result = Artisan::output();

        $this->assertEquals($result, '-1');
    }

    public function testFormulation()
    {
        //First parameter is N, next parameters are elements of array
        Artisan::call('separate', [5, 5, 5, 1, 7, 2, 3, 5]);

        $result = Artisan::output();

        $this->assertEquals($result, '4');
    }


}