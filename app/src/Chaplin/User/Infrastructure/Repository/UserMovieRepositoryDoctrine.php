<?php

declare(strict_types=1);

namespace Chaplin\User\Infrastructure\Repository;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Core\Infrastructure\AbstractDoctrineRepository;
use Chaplin\User\Domain\Entity\UserMovie;
use Chaplin\User\Domain\Repository\UserMovieRepository;

final class UserMovieRepositoryDoctrine extends AbstractDoctrineRepository implements UserMovieRepository
{
    private const ALIAS = 'user_movies';
    private const TABLE_NAME = 'user_movies';

    public function className(): string
    {
        return UserMovie::class;
    }

    public function dqlAlias(): string
    {
        return self::ALIAS;
    }

    public function save(UserMovie $userMovie): void
    {
        $this->entityManager->persist($userMovie);
        $this->entityManager->flush();
    }

    public function getUserMovieByUserIdAndMovieId(Id $userId, Id $movieId): ?UserMovie
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('um')
            ->from(UserMovie::class, 'um')
            ->where('um.user = :userId')
            ->andWhere('um.movie = :movieId')
            ->setParameter('userId', $userId->id())
            ->setParameter('movieId', $movieId->id());

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
