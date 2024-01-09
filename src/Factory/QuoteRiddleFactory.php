<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Factory;

use TroisOlen\PhpunitTp\DataProvider\QuoteDataProviderInterface;
use TroisOlen\PhpunitTp\Model\QuoteDto;

final class QuoteRiddleFactory extends AbstractStaticFactory
{
    public static function getRandomRiddle(QuoteDataProviderInterface $source): QuoteDto
    {
        return $source->getRandom();
    }
}
