<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class AnswerMediaRiddleCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('media-quiz:riddle')
            ->setDescription('Asks a riddle about a quote in a media and checks the answer.')
            ->setHelp('This command asks a riddle to user and waits for the correct answer or a request to give up.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle(input: $input, output: $output);
        $io->title('Hello there! Can you find the media name of this quote?');
        $io->note('Type « /gg » to give up.');

        $io->text('« C\'est pas faux! »');
        $io->ask(
            question: 'Your answer',
            validator: function (?string $answer): string {
                $answer = trim(mb_strtolower($answer ?? ''));

                if ($answer === '/gg' || $answer === '') {
                    throw new RuntimeException('You gave up!');
                }
                if ($answer !== 'kaamelott') {
                    throw new \Exception('Wrong answer!');
                }

                return $answer;
            },
        );

        $io->success('Congratulations, you found the answer!');

        return Command::SUCCESS;
    }
}