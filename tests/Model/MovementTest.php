<?php

namespace Tests\Entity;

use App\Model\Movement;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MovementTest extends TestCase
{
    public function invalidMovementData(): array
    {
        return [
            [''],
            ['T'],
            ['1'],
            ['*'],
        ];
    }


    /**
     * @dataProvider invalidMovementData
     */
    public function testWhenInvalidMovementIsProvided($data)
    {
        $this->expectException(InvalidArgumentException::class);
        new Movement($data);
    }


    public function testMovementRightSpin()
    {
         $movement  = new Movement('R');
         $this->assertTrue($movement->spinRight());
         $this->assertFalse($movement->spinLeft());
         $this->assertFalse($movement->moveForward());
    }

    public function testMovementLeftSpin()
    {
         $movement  = new Movement('L');
         $this->assertTrue($movement->spinLeft());
         $this->assertFalse($movement->spinRight());
         $this->assertFalse($movement->moveForward());
    }

    public function testMovementMoveForward()
    {
         $movement  = new Movement('M');
         $this->assertTrue($movement->moveForward());
         $this->assertFalse($movement->spinRight());
         $this->assertFalse($movement->spinLeft());
    }
}
