<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Foundation\Inspiring;
use Konstmal\Separator\Separator;

class Separate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'separate {number} {array*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Separate an array got from by parameters of command line';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $number = intval($this->argument('number'));
        $array = $this->argument('array');

        $result = Separator::separate($array, $number);
        $this->info($result);
    }
}
