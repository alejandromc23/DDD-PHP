<?php


namespace Chaplin\User\Domain\Repository;


use Chaplin\User\Domain\Entity\User;

interface UserRepository
{
    public function save(User $user): void;
}