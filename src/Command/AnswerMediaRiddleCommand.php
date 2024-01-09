<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TroisOlen\PhpunitTp\DataProvider\JsonConverterQuoteDataProvider;
use TroisOlen\PhpunitTp\Factory\QuoteRiddleFactory;
use TroisOlen\PhpunitTp\Service\QuoteAnswerChecker;

final class AnswerMediaRiddleCommand extends Command
{
    public function __construct(
        private readonly QuoteAnswerChecker $quoteAnswerChecker,
        private readonly QuoteRiddleFactory $quoteRiddleFactory,
    ) {
        parent::__construct();
    }

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

        $generatedRiddle = $this->quoteRiddleFactory->getRandomRiddle(
            source: new JsonConverterQuoteDataProvider(filePath: __DIR__ . '/../../data/quotes.json'),
        );

        $io->text("« $generatedRiddle->riddle »");
        $io->ask(
            question: 'Your answer',
            validator: function (?string $answer) use ($generatedRiddle): string {
                $answer = $this->quoteAnswerChecker->getSanitizedPrompt($answer);

                if ($answer === '/gg' || $answer === '') {
                    throw new RuntimeException('You gave up!');
                }
                if (
                    $this->quoteAnswerChecker->isValid(quoteAnswer: $generatedRiddle->answer, prompt: $answer) === false
                ) {
                    throw new \Exception('Wrong answer!');
                }

                return $answer;
            },
        );

        $io->success('Congratulations, you found the answer!');
        $io->block(
            messages: [
                "« $generatedRiddle->riddle »",
                "{$generatedRiddle->answer->from}"
                    . ($generatedRiddle->answer->to !== null ? " to {$generatedRiddle->answer->to}" : '')
                    . " -- {$generatedRiddle->answer->media->name} by {$generatedRiddle->answer->media->author}"
                    . " ({$generatedRiddle->answer->media->year}).",
            ],
            style: 'fg=black;bg=cyan'
        );

        return Command::SUCCESS;
    }
}
