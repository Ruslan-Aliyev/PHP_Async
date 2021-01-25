<?php

require "vendor/autoload.php";

use Spatie\Async\Pool;

$pool = Pool::create();

$pool
    ->add(function () {
        sleep(10);
        return 1;
    })
    ->then(function ($output) {
        echo $output;
    })
    ->catch(function ($exception) {
        var_dump($exception);
    });

echo 2;

$pool->wait();
