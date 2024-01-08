<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Model;

final readonly class AnswerDto
{
    public function __construct(
        public MediaDto $media,
        public ?string $from,
        public ?string $to = null,
    ) {
    }
}
