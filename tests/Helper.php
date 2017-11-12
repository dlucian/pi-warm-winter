<?php

use Warmer\Warmer;

class HeatingDevice 
{
    protected $values = array();
    
    public function set($output, $value) {
        $this->values[$output] = $value;
    }
    
    public function get($output) {
        return isset($this->values[$output]) ? $this->values[$output] : null;
    }   
}

class SensorShield
{
    protected $values = array();
    
    public function set($sensor, $value) {
        $this->values[$sensor] = $value;
    }
    
    public function read($sensor) {
        return isset($this->values[$sensor]) ? $this->values[$sensor] : null;
    }
}

class PushSensor extends SensorShield
{
    
}

class DisplayDevice
{
    public $lastDisplayed = '';
    
    public function display($message) 
    {
        $this->lastDisplayed = $message;
    }
}

class TemperatureSensor
{
    public function read($sensor) {
        switch ($sensor) {
            case Warmer::ROOM_1: return 31; break;
            case Warmer::ROOM_2: return 32; break;
            case Warmer::ROOM_3: return 33; break;
            default: return 20;
        }
    }
}