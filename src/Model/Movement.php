<?php

namespace App\Model;

use InvalidArgumentException;

class Movement
{
    const AVAILABLE_MOVEMENTS = ['L', 'M', 'R'];
    private string|null $movement = null;

    public function __construct(string $movement)
    {
        if (!in_array($movement, Movement::AVAILABLE_MOVEMENTS)) {
            throw new InvalidArgumentException('Invalid movement');
        }

        $this->movement = $movement;
    }

    public function moveForward(): bool
    {
        return $this->movement === 'M';
    }

    public function spinLeft(): bool
    {
        return $this->movement === 'L';
    }

    public function spinRight(): bool
    {
        return $this->movement === 'R';
    }
}
