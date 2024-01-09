<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Factory;

abstract class AbstractStaticFactory
{
    final private function __construct()
    {
        throw new \RuntimeException('A `StaticFactory` must not be instantiated.');
    }
}
