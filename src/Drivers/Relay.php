<?php

require '../../vendor/autoload.php';

//namespace Warmer\Drivers;

use PhpGpio\Gpio;

$pins = array(17, 18, 22);

echo "Setting up pin 17\n";
$gpio = new GPIO();
foreach ($pins as $pin) {
    $gpio->setup($pin, "out");
}

while (0) {
  foreach ($pins as $pin) {
    echo "Turning on pin $pin\n";
    $gpio->output($pin, 0);
    echo "Sleeping!\n";
    usleep(400000);

    echo "Turning off pin $pin\n";
    $gpio->output($pin, 1);
    usleep(400000);
  }
}

echo "Unexporting all pins\n";
$gpio->unexportAll();

