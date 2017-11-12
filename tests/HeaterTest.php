<?php

require_once(dirname(__FILE__) . '/Helper.php');

use PHPUnit\Framework\TestCase;
use Warmer\Warmer;

class HeaterTest extends TestCase
{
    /** @test */
    public function it_keeps_status_of_heater_state()
    {
        // Arrange
        $warmer = new Warmer();
        $heater = new HeatingDevice();
        $warmer->connectHeater($heater);
    
        // Act 
        $warmer->turnOn(Warmer::ROOM_1);
        $isHeated = $warmer->isHeated(Warmer::ROOM_1);
        
        // Assert
        $this->assertTrue($isHeated);
    }    
}