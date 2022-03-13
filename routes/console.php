<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('cr7', function () {
    sleep(1);
    $this->comment(PHP_EOL.'3');
    sleep(1);
    $this->comment('2');
    sleep(1);
    $this->comment('1');
    sleep(1);
    $this->comment(PHP_EOL.'DAI SIO PORCO SIUUUUUM'.PHP_EOL);
});
