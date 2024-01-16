<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Repository;

interface MovieRepositoryInterface
{
    public function exist(int $id): bool;
}
