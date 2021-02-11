<?php

namespace Tests\Entity;

use App\Model\Command;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function invalidData(): array
    {
        return [
            [''],
            ['abc'],
            ['1'],
            ['*'],
        ];
    }

    /**
     * @dataProvider invalidData
     * @param $data
     */
    public function testWhenInvalidCommandIsProvided($data)
    {
        $this->expectException(\InvalidArgumentException::class);
        Command::parseFromString($data);
    }

    public function testMovementCountWhenValidCommandIsProvided()
    {
        $command = Command::parseFromString('LMR');
        $this->assertCount(3, $command->getMovements());
    }
}
