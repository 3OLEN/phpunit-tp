<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Service\Validator;

use TroisOlen\PhpunitTp\Entity\Movie;
use TroisOlen\PhpunitTp\Exception\Service\Validator\InvalidLoadedEntityException;
use TroisOlen\PhpunitTp\Repository\MovieRepositoryInterface;

class MovieEntityValidator
{
    public function __construct(
        private readonly MovieRepositoryInterface $movieRepository,
    ) {
    }

    public function assertValidity(Movie $movie): void
    {
        // From database
        if ($movie->getId() === null || $this->movieRepository->exist($movie->getId()) === false) {
            throw new InvalidLoadedEntityException(
                entity: (new \ReflectionClass($movie))->name,
                id: $movie->getId(),
                reason: 'does not exist in database'
            );
        }

        // Fields
        if ($movie->getName() === null || $movie->getDirector() === null || $movie->getYear()) {
            throw new InvalidLoadedEntityException(
                entity: (new \ReflectionClass($movie))->name,
                id: $movie->getId(),
                reason: 'incomplete: no name or director or year data'
            );
        }
    }
}
