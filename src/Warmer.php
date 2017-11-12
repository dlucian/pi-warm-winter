<?php

namespace Warmer;

class Warmer {

    const OUTSIDE = 0;
    const ROOM_1 = 1;
    const ROOM_2 = 2;
    const ROOM_3 = 3;
    
    const PUSH_THRESHOLD = 300;

    protected $temperatureSensor = null;
    protected $displayDevice = null;
    protected $pushSensor = null;
    protected $relayDevice = null;
    
    protected $temperatures = array();
    protected $presence = array();
    protected $heaters = array();

    public function __construct() {
        //
    }
    
    public function connectTemperature($temperatureSensor) {
        $this->temperatureSensor = $temperatureSensor;
    }
    
    public function connectDisplay($displayDevice) {
        $this->displayDevice = $displayDevice;
    }
    
    public function connectPush($pushSensor) {
        $this->pushSensor = $pushSensor;
    }
    
    public function connectHeater($relayDevice) {
        $this->relayDevice = $relayDevice;
    }

    public function readTemperatures()
    {
        foreach (array(self::OUTSIDE, self::ROOM_1, self::ROOM_2, self::ROOM_3) as $temp) {
            $this->temperatures[$temp] = $this->temperatureSensor->read($temp);
        }
    }
    
    public function readPresence()
    {
        foreach (array(self::ROOM_1, self::ROOM_2, self::ROOM_3) as $room) {
            $this->presence[$room] = false;
            if ($this->pushSensor->read($room) >= self::PUSH_THRESHOLD) {
                $this->presence[$room] = true;
            }
        }   
    }
    
    public function isPresent($room)
    {
        return $this->presence[$room];
    }
    
    public function getTemperature($sensor)
    {
        return $this->temperatures[$sensor];
    }
    
    public function displayStatus()
    {
        $this->displayDevice->display(sprintf("%04.2f", $this->temperatures[self::OUTSIDE]));
    }
    
    public function turnOn($room) 
    {
        $this->relayDevice->set($room, 1);
        $this->heaters[$room] = 1;
    }
    
    public function isHeated($room) 
    {
        return isset($this->heaters[$room]) ? !empty($this->heaters[$room]) : null;
    }
}
