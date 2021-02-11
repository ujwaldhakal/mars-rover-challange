<?php

namespace App\Model;

use InvalidArgumentException;

class Command
{
    /**
     * @var Movement[]|null
     */
    private ?array $movements = null;

    private function __construct(array $movements)
    {
        $this->movements = $movements;
    }


    public function getMovements(): ?array
    {
        return $this->movements;
    }

    public static function parseFromString(string $command) : Command
    {
        $movements = str_split($command);

        $commands = [];
        foreach ($movements as $movement) {
            $commands[] = new Movement($movement);
        }

        return new Command($commands);
    }
}
