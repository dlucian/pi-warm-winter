<?php

namespace Warmer\Drivers;

//require '../../vendor/autoload.php';
use PhpGpio\Gpio;

// we use BCM pins 16, 20, 21

class Relay {
    protected $relays = array(
        0 => 23,
        1 => 24,
        2 => 25
    );

    protected $values = array();

    protected $GPIO = null;

    function __construct() 
    {
        $this->GPIO = new GPIO();
        foreach ($this->relays as $relay => $pin) {
          $this->GPIO->setup($pin, "out");
	  $this->turnOff($relay);
	  $this->values[$relay] = 0;
        }
    }

    function turnOn($relay) 
    {
    	$this->GPIO->output($this->relays[$relay], 0);
        $this->values[$relay] = 1; 
    }	

    function turnOff($relay)
    {
        $this->GPIO->output($this->relays[$relay], 1);
        $this->values[$relay] = 0;
    }

    function isHeated($relay)
    {
       return $this->values[$relay];
    }

}
/*
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

*/
