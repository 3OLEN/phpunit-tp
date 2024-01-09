<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\DataProvider;

use TroisOlen\PhpunitTp\Model\QuoteDto;

interface QuoteDataProviderInterface
{
    public function getRandom(): QuoteDto;
}
