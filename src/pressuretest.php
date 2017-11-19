<?php

require '../vendor/autoload.php';

use PhpGpio\Gpio;

echo "Setting up pin 14\n";
$gpio = new GPIO();
$gpio->setup(14, "in");

while (1) {
    // echo "Turning on pin $pin\n";
    $input = $gpio->input(14);
    echo sprintf("INPUT %s", $input);
    usleep(400000);
}

echo "Unexporting all pins\n";
$gpio->unexportAll();
