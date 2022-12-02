<?php

namespace App\Command;

use App\Entity\Elf;
use App\Entity\ElfCollection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'adventofcode:day:1',
    description: 'Day 1: Calorie Counting',
)]
class AdventofcodeDay1Command extends Command
{
    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $file = fopen('private/day1.txt', "r");

        $currentElf = 1;
        $elf = null;

        $collection = new ElfCollection();

        while ($line = fgets($file)) {

            if (null === $elf) {
                $io->section('Start elf ' . $currentElf);
                $elf = new Elf($currentElf);
            }

            //If we have a non blank line, add calories
            if (PHP_EOL !== $line) {
                $elf->addCalories((int)$line);
                continue;
            }


            $io->note('This elf has ' . $elf->countCalories() . ' calories');

            $collection->add($elf);
            $currentElf++;
            $elf = null;
        }

        /** @var Elf $bestElf */
        $calories = $collection->countCalories(1);

        $io->note('Result is : ' .$calories);

        $calories = $collection->countCalories(3);

        $io->note('Total for 3 best elfs calories is : ' . $calories);

        return Command::SUCCESS;
    }
}