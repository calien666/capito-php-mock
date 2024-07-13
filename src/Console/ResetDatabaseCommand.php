<?php

declare(strict_types=1);

namespace Capito\Console;

use Capito\Configuration;
use Capito\Database\ResetDatabase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'capito:mock:reset',
    description: 'resets database to default',
    aliases: ['c:m:reset'],
    hidden: false
)]
class ResetDatabaseCommand extends Command
{
    protected function configure(): void
    {
        $this->setDefinition(new InputDefinition([
            new InputOption(
                'yes',
                'y',
                InputOption::VALUE_NONE,
                'Force reset without asking to execute'
            )
        ]));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $reset = $input->getOption('yes');
        $io = new SymfonyStyle($input, $output);
        if (!$reset) {
            $io->info('Reset aborted. You have to explicit allow the reset');
            return Command::SUCCESS;
        }
        ResetDatabase::reset();
        return Command::SUCCESS;
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $inputOption = $input->getOption('yes');
        if (!$inputOption) {
            $io = new SymfonyStyle($input, $output);
            $result = $io->askQuestion(new ConfirmationQuestion('This will reset your entire database for the mock. Do you want to continue?', false));
            $input->setOption('yes', $result);
        }
    }
}
