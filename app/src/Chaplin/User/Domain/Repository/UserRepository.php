<?php

namespace Chaplin\User\Domain\Repository;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\User\Domain\Entity\User;
use Chaplin\User\Domain\ValueObject\Email;
use Chaplin\User\Domain\ValueObject\Username;

interface UserRepository
{
    public function save(User $user): void;

    public function getByEmail(Email $email): array;

    public function getByUsername(Username $username): array;

    public function userHasMovieByUserIdAndMovieId(Id $userId, Id $movieId): bool;
}
