<?php

require_once(dirname(__FILE__) . '/Helper.php');

use PHPUnit\Framework\TestCase;
use Warmer\Warmer;

class PushTest extends TestCase
{
        /** @test */
    public function it_settles_not_present_if_push_sensor_below_threshold()
    {
        // Arrange
        $pushSensor = new PushSensor();
        $warmer = new Warmer();
        $warmer->connectPush($pushSensor);
    
        // Act 
        $pushSensor->set(Warmer::ROOM_1, 14);
        $warmer->readPresence();
        $isPresent1 = $warmer->isPresent(Warmer::ROOM_1);
        
        // Assert
        $this->assertFalse($isPresent1);
    }
    
    /** @test */
    public function it_settles_present_if_push_sensor_over_threshold()
    {
        // Arrange
        $pushSensor = new PushSensor();
        $warmer = new Warmer();
        $warmer->connectPush($pushSensor);
    
        // Act 
        $pushSensor->set(Warmer::ROOM_1, 1000);
        $warmer->readPresence();
        $isPresent1 = $warmer->isPresent(Warmer::ROOM_1);
        
        // Assert
        $this->assertTrue($isPresent1);
    }
    
    /** @test */
    public function it_keeps_presence_status_for_each_room()
    {
        // Arrange
        $pushSensor = new PushSensor();
        $warmer = new Warmer();
        $warmer->connectPush($pushSensor);
    
        // Act 
        $pushSensor->set(Warmer::ROOM_1, 1000);
        $pushSensor->set(Warmer::ROOM_2, 44);
        $pushSensor->set(Warmer::ROOM_3, 900);
        $warmer->readPresence();
        
        // Assert
        $this->assertTrue($warmer->isPresent(Warmer::ROOM_1));
        $this->assertFalse($warmer->isPresent(Warmer::ROOM_2));
        $this->assertTrue($warmer->isPresent(Warmer::ROOM_3));
    }

}   