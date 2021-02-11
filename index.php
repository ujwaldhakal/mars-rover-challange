<?php

require 'vendor/autoload.php';

use App\Entity\Rover;
use App\Model\Command;
use App\Model\Position;

function dd($variable)
{
    echo '<pre>';
    die(var_dump($variable));
    echo '</pre>';
}

$input = explode("\n", file_get_contents("input.txt")); //since input is not heavy so i am loading all on memory
$plateauMaxCordinate = $input[0];
array_shift($input); // unsetting
for ($i = 0; $i < count($input) - 1; ++$i) {
    if ($i % 2 === 0) {
        $unformattedPosition = $input[$i];
        $roverPosition = Position::parseFromString($unformattedPosition);
        $command = Command::parseFromString($input[$i + 1]);
        $rover = new Rover($roverPosition);
        $rover->move($command);
        $finalPosition = $rover->getPosition();
        echo "<pre>";
        echo "INPUT : $unformattedPosition ";
        echo "OUTPUT : $finalPosition ";
        echo '</pre>';
    }
}
