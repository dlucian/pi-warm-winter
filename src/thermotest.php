<?php

require '../vendor/autoload.php';

use PhpGpio\Gpio;
use PhpGpio\Sensors\DS18B20;

$sensor1 = new DS18B20();
$sensor1->setBus('/sys/bus/w1/devices/28-031770ee98ff/w1_slave');
$sensor2 = new DS18B20();
$sensor2->setBus('/sys/bus/w1/devices/28-031771406dff/w1_slave');
//$result = $sensor->guessBus();
//echo "BUS: " . $result;



for ($i=1000; $i>0; $i--) {
	//$result = $sensor->read();
	echo sprintf("\nT1 = %4.2f T2 = %4.2f", $sensor1->read(), $sensor2->read());
}

