<?php

namespace Chaplin\User\Infrastructure\Repository;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Core\Infrastructure\AbstractDoctrineRepository;
use Chaplin\User\Domain\Entity\User;
use Chaplin\User\Domain\Entity\UserMovie;
use Chaplin\User\Domain\Repository\UserRepository;
use Chaplin\User\Domain\ValueObject\Email;
use Chaplin\User\Domain\ValueObject\Username;

class UserRepositoryDoctrine extends AbstractDoctrineRepository implements UserRepository
{
    private const ALIAS = 'user';
    private const TABLE_NAME = 'user';

    public function className(): string
    {
        return User::class;
    }

    public function dqlAlias(): string
    {
        return self::ALIAS;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function getByEmail(Email $email): array
    {
        $connection = $this->entityManager->getConnection();

        $query = sprintf('SELECT * FROM user
            WHERE email = \'%s\';
        ', $email->email());

        $statement = $connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getByUsername(Username $username): array
    {
        $connection = $this->entityManager->getConnection();

        $query = sprintf('SELECT * FROM user
            WHERE username = \'%s\';
        ', $username->username());

        $statement = $connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function userHasMovieByUserIdAndMovieId(Id $userId, Id $movieId): bool
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('um')
            ->from(UserMovie::class, 'um')
            ->where('um.user = :userId')
            ->andWhere('um.movie = :movieId')
            ->setParameter('userId', $userId->id())
            ->setParameter('movieId', $movieId->id());

        return !empty($queryBuilder->getQuery()->getOneOrNullResult());
    }
}
