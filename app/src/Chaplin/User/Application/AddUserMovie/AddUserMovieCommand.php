<?php

declare(strict_types=1);

namespace Chaplin\User\Application\AddUserMovie;

use Chaplin\Core\Domain\ValueObject\Id;
use Symfony\Component\Security\Core\User\UserInterface;

final class AddUserMovieCommand
{
    public function __construct(
        private UserInterface $user,
        private Id $movieId
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
}
