<?php

declare(strict_types=1);

namespace Chaplin\User\Domain\Repository;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\User\Domain\Entity\UserMovie;

interface UserMovieRepository
{
    public function save(UserMovie $userMovie): void;

    public function getUserMovieByUserIdAndMovieId(Id $userId, Id $movieId): ?UserMovie;
}
