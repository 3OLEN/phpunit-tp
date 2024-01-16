<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Service\Validator;

use TroisOlen\PhpunitTp\Entity\Quote;
use TroisOlen\PhpunitTp\Exception\Service\Validator\InvalidLoadedEntityException;
use TroisOlen\PhpunitTp\Repository\QuoteRepositoryInterface;

class QuoteEntityValidator
{
    public function __construct(
        private readonly QuoteRepositoryInterface $quoteRepository,
        private readonly MovieEntityValidator $movieEntityValidator,
    ) {
    }

    public function assertValidity(Quote $quote): void
    {
        // From database
        if ($quote->getId() === null || $this->quoteRepository->exist($quote->getId()) === false) {
            throw new InvalidLoadedEntityException(
                entity: (new \ReflectionClass($quote))->name,
                id: $quote->getId(),
                reason: 'does not exist in database'
            );
        }

        // Fields
        if ($quote->getValue() === null || $quote->getMovie() === null) {
            throw new InvalidLoadedEntityException(
                entity: (new \ReflectionClass($quote))->name,
                id: $quote->getId(),
                reason: 'incomplete: no value or movie data'
            );
        }
        // * Movie
        try {
            $this->movieEntityValidator->assertValidity($quote->getMovie());
        } catch (InvalidLoadedEntityException $movieValidityException) {
            throw new InvalidLoadedEntityException(
                entity: (new \ReflectionClass($quote))->name,
                id: $quote->getId(),
                reason: "invalid $movieValidityException->entity entity",
                previous: $movieValidityException
            );
        }
    }
}
