<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Factory;

use TroisOlen\PhpunitTp\Entity\Quote;
use TroisOlen\PhpunitTp\Enum\MediaTypeEnum;
use TroisOlen\PhpunitTp\Model\AnswerDto;
use TroisOlen\PhpunitTp\Model\MediaDto;
use TroisOlen\PhpunitTp\Model\QuoteDto;
use TroisOlen\PhpunitTp\Service\Validator\QuoteEntityValidator;

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

    public static function createFromEntity(Quote $quoteEntity, QuoteEntityValidator $quoteValidator): QuoteDto
    {
        // Assert entity is valid
        $quoteValidator->assertValidity($quoteEntity);

        return new QuoteDto(
            riddle: $quoteEntity->getValue(),
            answer: new AnswerDto(
                media: new MediaDto(
                    name: $quoteEntity->getMovie()->getName(),
                    author: $quoteEntity->getMovie()->getDirector(),
                    year: $quoteEntity->getMovie()->getYear(),
                    type: MediaTypeEnum::MOVIE
                ),
                from: $quoteEntity->getCharacter()
            )
        );
    }
}
