<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Factory;

use TroisOlen\PhpunitTp\Model\QuoteDto;
use TroisOlen\PhpunitTp\Service\QuoteSource\QuoteDataProviderInterface;

final class QuoteRiddleFactory
{
    public function getRandomRiddle(QuoteDataProviderInterface $source): QuoteDto
    {
        return $source->getRandom();
    }
}
