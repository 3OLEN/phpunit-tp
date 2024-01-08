<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Factory;

use TroisOlen\PhpunitTp\Model\QuoteDto;
use TroisOlen\PhpunitTp\Service\QuoteSource\QuoteSourceInterface;

final class QuoteRiddleFactory
{
    public function getRandomRiddle(QuoteSourceInterface $source): QuoteDto
    {
        return $source->getRandom();
    }
}
