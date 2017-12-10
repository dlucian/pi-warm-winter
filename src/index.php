<?php

require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use Warmer\Warmer;
use Warmer\Drivers\Thermo;
use Warmer\Drivers\Display;
use Warmer\Drivers\Relay;

$warmer = new Warmer();

//connect thermo driver
$thermo = new Thermo();
echo sprintf("THERMO %f %f\n", $thermo->read(0), $thermo->read(1));
//connect push driver
//connect display driver
$display = new Display();
//while(true) {
  $display->show($thermo->read(0), $thermo->read(1));
//}

//connect relay(heater) driver
$relay = new Relay();

/*
foreach(array(0,1,2) as $i) {
$relay->turnOn($i);
sleep(1);
$relay->turnOff($i);
sleep(1);
}*/

while(true) {
  $inTemp = $thermo->read(1);
  $outTemp = $thermo->read(0);
  if ($outTemp > 10) {
    $display->show($outTemp, null);
    $relay->turnOff(1);
    sleep(1); 
  } else {
    $display->show($outTemp, $inTemp);
    if ($inTemp < 4.5) {
      $relay->turnOn(1);
    } elseif ($inTemp > 5.5) {
      $relay->turnOff(1);
    }
  }
}


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


