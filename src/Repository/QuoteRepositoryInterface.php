<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Repository;

use TroisOlen\PhpunitTp\Entity\Quote;

interface QuoteRepositoryInterface
{
    public function getRandom(): Quote;

    public function exist(int $id): bool;
}
