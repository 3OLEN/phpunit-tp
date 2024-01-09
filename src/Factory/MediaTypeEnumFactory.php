<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Factory;

use TroisOlen\PhpunitTp\Enum\MediaTypeEnum;

final class MediaTypeEnumFactory extends AbstractStaticFactory
{
    public static function getFromConverter(string $mediaValue): MediaTypeEnum
    {
        return match (mb_strtolower($mediaValue)) {
            'movie' => MediaTypeEnum::MOVIE,
            'series' => MediaTypeEnum::SERIES,
            default => throw new \InvalidArgumentException('Invalid media type'),
        };
    }
}
