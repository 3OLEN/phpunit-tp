<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Model;

final readonly class QuoteDto
{
    public function __construct(
        public string $riddle,
        public AnswerDto $answer,
    ) {
    }
}
