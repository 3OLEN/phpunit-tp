<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Factory;

use TroisOlen\PhpunitTp\Model\AnswerDto;
use TroisOlen\PhpunitTp\Model\MediaDto;
use TroisOlen\PhpunitTp\Model\QuoteDto;

final class QuoteRiddleFactory extends AbstractStaticFactory
{
    public static function createFromStdClass(\stdClass $quoteStdClass): QuoteDto
    {
        return new QuoteDto(
            riddle: $quoteStdClass->riddle,
            answer: new AnswerDto(
                media: new MediaDto(
                    name: $quoteStdClass->answer->media->name,
                    author: $quoteStdClass->answer->media->author,
                    year: $quoteStdClass->answer->media->year,
                    type: MediaTypeEnumFactory::getFromConverter(mediaValue: $quoteStdClass->answer->media->type),
                ),
                from: $quoteStdClass->answer->from,
                to: $quoteStdClass->answer->to ?? null,
            ),
        );
    }
}
