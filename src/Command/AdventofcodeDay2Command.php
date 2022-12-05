<?php

namespace App\Command;

use App\Collection\Collection;

use App\Enum\Round;
use App\Enum\Shape;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'adventofcode:day:2',
    description: 'Rock Paper Scissors',
)]
class AdventofcodeDay2Command extends Command
{

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $data = explode(PHP_EOL, file_get_contents('private/day2.txt'));
        $data = array_map(static fn($row) => explode(' ', $row), $data);

        $collection = new Collection();

        foreach ($data as $game) {
            $player1 = Shape::match($game[0]);
            $player2 = Shape::match($game[1]);

            $points = Round::play($player1, $player2);

            $collection->add($points);
        }

        $io->success('Result is : ' . array_sum($collection->all()));

        return Command::SUCCESS;
    }
}
