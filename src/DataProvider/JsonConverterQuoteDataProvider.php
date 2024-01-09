<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\DataProvider;

use TroisOlen\PhpunitTp\Enum\MediaTypeEnum;
use TroisOlen\PhpunitTp\Model\AnswerDto;
use TroisOlen\PhpunitTp\Model\MediaDto;
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
            callback: fn (\stdClass $quote) => new QuoteDto(
                riddle: $quote->riddle,
                answer: new AnswerDto(
                    media: new MediaDto(
                        name: $quote->answer->media->name,
                        author: $quote->answer->media->author,
                        year: $quote->answer->media->year,
                        type: $this->getMediaType($quote->answer->media->type),
                    ),
                    from: $quote->answer->from,
                    to: $quote->answer->to ?? null,
                ),
            ),
            array: json_decode(json: file_get_contents($this->filePath), flags: JSON_THROW_ON_ERROR),
        );
    }

    private function getMediaType(mixed $type): MediaTypeEnum
    {
        return match ($type) {
            'MOVIE' => MediaTypeEnum::MOVIE,
            'SERIES' => MediaTypeEnum::SERIES,
            default => throw new \RuntimeException("Media type « $type » not found."),
        };
    }
}
