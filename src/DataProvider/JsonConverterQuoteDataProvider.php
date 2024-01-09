<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\DataProvider;

use TroisOlen\PhpunitTp\Factory\QuoteRiddleFactory;
use TroisOlen\PhpunitTp\Model\QuoteDto;

final class JsonConverterQuoteDataProvider implements QuoteDataProviderInterface
{
    private array $quotes = [];

    public function __construct(
        private readonly string $filePath,
    ) {
    }

    public function getRandom(): QuoteDto
    {
        $this->loadQuotes();

        return $this->quotes[array_rand($this->quotes)];
    }

    private function loadQuotes(): void
    {
        if (count($this->quotes) > 0) {
            return;
        }

        if (file_exists($this->filePath) === false) {
            throw new \RuntimeException("Data file « $this->filePath » not found.");
        }

        $this->quotes = array_map(
            callback: static fn (\stdClass $quote) => QuoteRiddleFactory::createFromStdClass($quote),
            array: json_decode(json: file_get_contents($this->filePath), flags: JSON_THROW_ON_ERROR),
        );
    }
}
