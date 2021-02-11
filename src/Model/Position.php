<?php
declare(strict_types=1);

namespace App\Model;

use InvalidArgumentException;

class Position
{
    private const NORTH = 'N';
    private const SOUTH = 'S';
    private const EAST = 'E';
    private const WEST = 'W';

    private const AVAILABLE_DIRECTIONS = [self::WEST, self::EAST, self::NORTH, self::SOUTH];

    private const LEFT_TO_RIGHT_DIRECTIONS = [
        self::NORTH => self::WEST,
        self::WEST => self::SOUTH,
        self::SOUTH => self::EAST,
        self::EAST => self::NORTH,
    ];

    private const RIGHT_TO_LEFT_DIRECTIONS = [
        self::NORTH => self::EAST,
        self::EAST => self::SOUTH,
        self::SOUTH => self::WEST,
        self::WEST => self::NORTH,
    ];

    private ?int $coordinateX = null;

    private ?int $coordinateY = null;

    private ?string $direction = null;

    /**
     * @param integer $coordinateX
     * @param integer $coordinateY
     * @param string $direction
     */
    private function __construct(int $coordinateX, int $coordinateY, string $direction)
    {
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
        $this->direction = $direction;
    }

    public function getCoordinateX(): ?int
    {
        return $this->coordinateX;
    }

    public function getCoordinateY(): ?int
    {
        return $this->coordinateY;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function changeDirectionRightToLeft()
    {
        $this->direction = self::RIGHT_TO_LEFT_DIRECTIONS[$this->direction];
    }

    public function changeDirectionLeftToRight()
    {
        $this->direction = self::LEFT_TO_RIGHT_DIRECTIONS[$this->direction];
    }

    public function moveCoordinate()
    {
        if ($this->direction === self::NORTH) {
            $this->coordinateY++;
        }

        if ($this->direction === self::SOUTH) {
            $this->coordinateY--;
        }

        if ($this->direction === self::EAST) {
            $this->coordinateX++;
        }

        if ($this->direction === self::WEST) {
            $this->coordinateX--;
        }
    }

    public static function parseFromString(string $positionString): Position
    {
        $positionArray = explode(" ", $positionString);

        if (count($positionArray) !== 3) {
            throw new InvalidArgumentException('Expected Input int(X Y Z) ');
        }
        $coordinateX = $positionArray[0];
        $coordinateY = $positionArray[1];

        if (!is_numeric($coordinateX) || !is_numeric($coordinateY)) {
            throw new InvalidArgumentException('Input values have to be Integer Expected Input (int(X) int(Y))');
        }
        $direction = $positionArray[2];

        if (!in_array($direction, self::AVAILABLE_DIRECTIONS)) {
            throw new InvalidArgumentException('Invalid direction provided');
        }
        return new Position((int)$coordinateX, (int)$coordinateY, $direction);
    }

}
