<?php

namespace Chaplin\User\Infrastructure\Repository;

use Chaplin\Core\Infrastructure\AbstractDoctrineRepository;
use Chaplin\User\Domain\Entity\User;
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
}
