<?php

namespace Tests\Entity;

use App\Entity\Rover;
use App\Model\Command;
use App\Model\Position;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    public function testRoverMovesCorrectlyWhenProvidedWithCommand()
    {
        $firstRoverDefaultPosition = Position::parseFromString('1 2 N');
        $firstRoverCommand = Command::parseFromString('LMLMLMLMM');
        $firstRover = new Rover($firstRoverDefaultPosition);
        $firstRover->move($firstRoverCommand);
        $this->assertEquals('1 3 N',$firstRover->getPosition());


        $secondRoverDefaultPosition = Position::parseFromString('3 3 E');
        $secondRoverCommand = Command::parseFromString('MMRMMRMRRM');
        $secondRover = new Rover($secondRoverDefaultPosition);
        $secondRover->move($secondRoverCommand);
        $this->assertEquals('5 1 E',$secondRover->getPosition());
    }
}
