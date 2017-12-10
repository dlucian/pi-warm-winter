<?php

require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use Warmer\Warmer;
use Warmer\Drivers\Thermo;
use Warmer\Drivers\Display;

$warmer = new Warmer();

//connect thermo driver
$thermo = new Thermo();
echo sprintf("THERMO %f %f\n", $thermo->read(0), $thermo->read(1));
//connect push driver
//connect display driver
$display = new Display();
while(true) {
$display->show($thermo->read(0), $thermo->read(1));
}

//connect relay(heater) driver
//turn off heaters
//display hello
//forever
//--heater statuses -> LEDs (1st 4 group)
//--read temperatures
//--display outside temperature
//--outside <= 5 degres?
//--NO: sleep 1 minute and continue
//--YES: display room1..3 temp & set LED (2nd group LED 1..3)
//---- if room1..3 temp < 4 deg. turn on heater & set LED (1st group)
//---- if room1..3 temp > 4.9 deg turn off heater & set LED (1st group)
//---- sleep 10 seconds, room++
//


