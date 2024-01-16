<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\DataProvider;

use TroisOlen\PhpunitTp\Factory\QuoteRiddleFactory;
use TroisOlen\PhpunitTp\Model\QuoteDto;
use TroisOlen\PhpunitTp\Repository\QuoteRepositoryInterface;
use TroisOlen\PhpunitTp\Service\Validator\QuoteEntityValidator;

final class DatabaseQuoteDataProvider implements QuoteDataProviderInterface
{
    public function __construct(
        private readonly QuoteRepositoryInterface $quoteRepository,
        private readonly QuoteEntityValidator $quoteValidator,
    ) {
    }


    public function getRandom(): QuoteDto
    {
        return QuoteRiddleFactory::createFromEntity(
            quoteEntity: $this->quoteRepository->getRandom(),
            quoteValidator: $this->quoteValidator
        );
    }
}
