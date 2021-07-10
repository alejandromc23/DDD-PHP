<?php

namespace Chaplin\Quote\Infrastructure\Repository;

use Chaplin\Core\Infrastructure\AbstractDoctrineRepository;
use Chaplin\Quote\Domain\Entity\Quote;
use Chaplin\Quote\Domain\Repository\QuoteRepository;

class QuoteRepositoryDoctrine extends AbstractDoctrineRepository implements QuoteRepository
{
    private const ALIAS = 'quote';

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Quote::class)->findAll();
    }

    public function className(): string
    {
        return Quote::class;
    }

    public function dqlAlias(): string
    {
        return self::ALIAS;
    }
}
