<?php

require_once(dirname(__FILE__) . '/Helper.php');

use PHPUnit\Framework\TestCase;
use Warmer\Warmer;

class DisplayTest extends TestCase
{
    
    /** @test */
    public function it_displays_outside_temperature()
    {
        // Arrange        
        $warmer = new Warmer();
        $sensor = new TemperatureSensor();
        $warmer->connectTemperature($sensor);
        $display = new DisplayDevice();
        $warmer->connectDisplay($display);
        
        // Act
        $warmer->readTemperatures(); 
        $temperatureOutside = $warmer->getTemperature(Warmer::OUTSIDE);
        
        $warmer->displayStatus();
        
        // Assert
        $this->assertContains('20', $display->lastDisplayed);
    }       
}