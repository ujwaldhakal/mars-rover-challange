<?php

namespace Tests\Entity;

use App\Model\Position;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    public function invalidPositions(): array
    {
        return [
            ['a 1 N'],
            ['1 a E'],
            ['1 2'],
            [''],
            ['1 2 F'],
        ];
    }

    public function movementsData(): array
    {
        return [
            [
                ['initial_coordinates' => '1 2 N',
                    'final_coordinates' => '1 3 N'
                ]
            ],
            [
                ['initial_coordinates' => '1 2 E',
                    'final_coordinates' => '2 2 E']
            ],
            [
                ['initial_coordinates' => '1 2 W',
                    'final_coordinates' => '0 2 W']
            ],
            [
                ['initial_coordinates' => '1 2 S',
                    'final_coordinates' => '1 1 S']
            ],
        ];
    }

    public function directionData(): array
    {
        return [
            [
                ['initial_direction' => 'N',
                    'final_direction' => 'E'
                ]
            ],
            [
                ['initial_direction' => 'E',
                    'final_direction' => 'S']
            ],
            [
                ['initial_direction' => 'S',
                    'final_direction' => 'W']
            ],
            [
                ['initial_direction' => 'W',
                    'final_direction' => 'N']
            ],
        ];
    }

    /**
     * @dataProvider invalidPositions
     * @param $invalidData
     */
    public function testPositionWhenProvidedWithInvalidData($invalidData)
    {
        $this->expectException(InvalidArgumentException::class);
        Position::parseFromString($invalidData);
    }

    public function testPositionWhenProvidedWithValidData()
    {
        $position = Position::parseFromString('1 2 N');
        $this->assertEquals(1, $position->getCoordinateX());
        $this->assertEquals(2, $position->getCoordinateY());
        $this->assertEquals('N', $position->getDirection());
    }


    /**
     * Testing rover in all direction
     * @dataProvider directionData
     * @param $data
     */
    public function testPositionWhenDirectionHasBeenChanged($data)
    {
        $position = Position::parseFromString("1 2 ".$data['initial_direction']);
        $position->changeDirectionRightToLeft();
        $this->assertEquals($data['final_direction'], $position->getDirection());


        $position = Position::parseFromString("1 2 ".$data['final_direction']);
        $position->changeDirectionLeftToRight();
        $this->assertEquals($data['initial_direction'], $position->getDirection());
    }

    /**
     * Testing rover movement from all direction
     * @dataProvider movementsData
     * @param $data
     */
    public function testPositionWhenMovedForward($data)
    {
        $position = Position::parseFromString($data['initial_coordinates']);
        $position->moveCoordinate();
        $this->assertEquals($data['final_coordinates'], $position->getCoordinateX() . ' ' . $position->getCoordinateY() . ' ' . $position->getDirection());
    }
}
