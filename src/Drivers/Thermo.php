<?php

require_once "../../vendor/autoload.php";

use Warmer\Interfaces\SensorInterface;
use PhpGpio\Gpio;
use PhpGpio\Sensors\DS18B20;

class Thermo implements SensorInterface {
    protected $sensors = array(
        0 => '031770ee98ff',
        1 => '031771406dff',
    );

    const busFile = '/sys/bus/w1/devices/28-%s/w1_slave';

    protected $buses = array();

    public function __construct() 
    {
        foreach ($this->sensors as $key => $id) {
           $this->buses[$key] = new DS18B20();
           $this->buses[$key]->setBus(sprintf(self::busFile, $id));
        }
    }

    public function read($sensor)
    {
       return $this->buses[$sensor]->read();
    }
}

/*
$thermo = new Thermo();
while(true) {
    echo sprintf("\nT1 = %4.2f T2 = %4.2f", $thermo->read(0), $thermo->read(1));
}
*/

/*
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
*/
