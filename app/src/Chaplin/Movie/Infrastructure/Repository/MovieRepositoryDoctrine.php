<?php

namespace Chaplin\Movie\Infrastructure\Repository;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Core\Infrastructure\AbstractDoctrineRepository;
use Chaplin\Movie\Domain\Entity\Movie;
use Chaplin\Movie\Domain\Repository\MovieRepository;

class MovieRepositoryDoctrine extends AbstractDoctrineRepository implements MovieRepository
{
    private const ALIAS = 'movies';
    private const TABLE_NAME = 'movies';

    public function className(): string
    {
        return Movie::class;
    }

    public function dqlAlias(): string
    {
        return self::ALIAS;
    }

    public function findById(Id $id): Movie
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('m')
            ->from(Movie::class, 'm')
            ->where('m.id = :id')
            ->setParameter('id', $id->id());

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @return Movie[]
     */
    public function findByTitleLike(string $title): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('m')
            ->from(Movie::class, 'm')
            ->where('m.title LIKE :title')
            ->setParameter('title', '%'.$title.'%')
            ->setMaxResults(15);

        return $queryBuilder->getQuery()->getResult();
    }
}
