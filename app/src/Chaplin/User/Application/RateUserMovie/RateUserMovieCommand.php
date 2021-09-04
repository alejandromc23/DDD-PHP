<?php

declare(strict_types=1);

namespace Chaplin\User\Application\RateUserMovie;

use Chaplin\Core\Domain\ValueObject\Id;
use Symfony\Component\Security\Core\User\UserInterface;

final class RateUserMovieCommand
{
    public function __construct(
        private UserInterface $user,
        private Id $movieId,
        private float $rating
    ) {
    }

    public function user(): UserInterface
    {
        return $this->user;
    }

    public function movieId(): Id
    {
        return $this->movieId;
    }

    public function rating(): float
    {
        return $this->rating;
    }
}
