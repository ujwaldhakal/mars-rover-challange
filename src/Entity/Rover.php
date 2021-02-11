<?php
declare(strict_types=1);

namespace App\Entity;

use App\Model\Command;
use App\Model\Position;
use JetBrains\PhpStorm\Pure;

class Rover
{
    private Position|null $position = null;


    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public function move(Command $command): void
    {
        foreach ($command->getMovements() as $movement) {

            if ($movement->moveForward()) {
                $this->position->moveCoordinate();
                continue;
            }

            if ($movement->spinLeft()) {
                $this->position->changeDirectionLeftToRight();
                continue;
            }

            if ($movement->spinRight()) {
                $this->position->changeDirectionRightToLeft();
            }
        }
    }

    #[Pure] public function getPosition(): string
    {
        return $this->position->getCoordinateX() . ' ' . $this->position->getCoordinateY() . ' ' . $this->position->getDirection();
    }
}
