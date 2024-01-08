<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Service;

use TroisOlen\PhpunitTp\Model\AnswerDto;

final class QuoteAnswerChecker
{
    public function isValid(AnswerDto $quoteAnswer, string $prompt): bool
    {
        return $this->getSanitizedPrompt($prompt) === mb_strtolower(trim($quoteAnswer->media->name));
    }

    public function getSanitizedPrompt(?string $prompt): string
    {
        return $prompt === null ? '' : mb_strtolower(trim($prompt));
    }
}
