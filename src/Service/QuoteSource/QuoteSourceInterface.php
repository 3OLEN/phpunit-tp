<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Service\QuoteSource;

use TroisOlen\PhpunitTp\Model\QuoteDto;

interface QuoteSourceInterface
{
    public function getRandom(): QuoteDto;
}
