<?php

require "vendor/autoload.php";

use Symfony\Component\Process\Process;

$process = new Process(['php', 'process.php']);

$process->start();

echo 2;

while ($process->isRunning())
{
    sleep(1);
}

echo $process->getOutput();
