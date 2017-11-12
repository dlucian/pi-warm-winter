<?php

require_once(dirname(__FILE__) . '/Helper.php');

use PHPUnit\Framework\TestCase;
use Warmer\Warmer;

class TemperatureTest extends TestCase
{
    /**
     * The main program loads up various drivers
     * such as temperature, current, pressure and
     * operates output such as relay and LED display.
     */
    /** @test */
    public function it_reads_temperature_values()
    {
        // Arrange
        $warmer = new Warmer();
        $sensor = new TemperatureSensor();
        $warmer->connectTemperature($sensor);
    
        // Act
        $warmer->readTemperatures(); 
        $temperatureOutside = $warmer->getTemperature(Warmer::OUTSIDE);
        
        // Assert
        $this->assertTrue(is_numeric($temperatureOutside));
    }
    
    /** @test */
    public function it_stores_outside_temperature()
    {
        // Arrange
        $warmer = new Warmer();
        $sensor = new TemperatureSensor();
        $warmer->connectTemperature($sensor);
    
        // Act 
        $warmer->readTemperatures(); 
        $temperatureOutside = $warmer->getTemperature(Warmer::OUTSIDE);
        
        // Assert
        $this->assertEquals(20, $temperatureOutside);
    }
    
    /** @test */
    public function it_stores_internal_temperatures()
    {
        // Arrange
        $warmer = new Warmer();
        $sensor = new TemperatureSensor();
        $warmer->connectTemperature($sensor);
        
        // Act 
        $warmer->readTemperatures(); 
        $temperatures = array(
            1 => $warmer->getTemperature(Warmer::ROOM_1),
            2 => $warmer->getTemperature(Warmer::ROOM_2), 
            3 => $warmer->getTemperature(Warmer::ROOM_3),
        );
        
        // Assert
        $this->assertEquals(31, $temperatures[1]);
        $this->assertEquals(32, $temperatures[2]);
        $this->assertEquals(33, $temperatures[3]);
    }    
}
