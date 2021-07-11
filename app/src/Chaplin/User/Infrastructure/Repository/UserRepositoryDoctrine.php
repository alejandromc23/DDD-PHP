<?php


namespace Chaplin\User\Infrastructure\Repository;


use Chaplin\Core\Infrastructure\AbstractDoctrineRepository;
use Chaplin\User\Domain\Entity\User;
use Chaplin\User\Domain\Repository\UserRepository;

class UserRepositoryDoctrine extends AbstractDoctrineRepository implements UserRepository
{
    private const ALIAS = 'user';

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
}