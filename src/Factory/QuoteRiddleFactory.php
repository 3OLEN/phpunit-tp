<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Factory;

use TroisOlen\PhpunitTp\Enum\MediaTypeEnum;
use TroisOlen\PhpunitTp\Model\AnswerDto;
use TroisOlen\PhpunitTp\Model\MediaDto;
use TroisOlen\PhpunitTp\Model\QuoteDto;

final class QuoteRiddleFactory
{
    public function generateRiddle(): QuoteDto
    {
        return new QuoteDto(
            riddle: 'C\'est pas faux!',
            answer: new AnswerDto(
                media: new MediaDto(
                    name: 'Kaamelott',
                    author: 'Alexandre Astier',
                    year: 2005,
                    type: MediaTypeEnum::SERIES,
                ),
                from: 'Perceval',
                to: 'Arthur',
            ),
        );
    }
}
