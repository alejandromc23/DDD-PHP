<?php

namespace Chaplin\Movie\Infrastructure\Repository;

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

    public function findByTitleLike(string $title): array
    {
        $connection = $this->entityManager->getConnection();

        $query = sprintf('SELECT * FROM movies
            WHERE title LIKE \'%%%s%%\';
        ', $title);

        $statement = $connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }
}
