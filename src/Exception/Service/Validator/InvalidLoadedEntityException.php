<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Exception\Service\Validator;

final class InvalidLoadedEntityException extends \InvalidArgumentException
{
    public function __construct(
        public readonly string $entity,
        ?int $id,
        string $reason,
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            message: "Given $entity entity"
                . ' ' . ($id === null ? '(--undefined id--)' : "(#$id)")
                . " is invalid: « $reason ».",
            previous: $previous
        );
    }
}
