<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Model;

use TroisOlen\PhpunitTp\Enum\MediaTypeEnum;

final readonly class MediaDto
{
    public function __construct(
        public string $name,
        public string $author,
        public int $year,
        public MediaTypeEnum $type,
    ) {
    }
}
