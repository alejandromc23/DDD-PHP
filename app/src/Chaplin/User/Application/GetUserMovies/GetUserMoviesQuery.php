<?php

declare(strict_types=1);

namespace Chaplin\User\Application\GetUserMovies;

use Symfony\Component\Security\Core\User\UserInterface;

final class GetUserMoviesQuery
{
    public function __construct(
        private UserInterface $user
    ) {
    }

    public function user(): UserInterface
    {
        return $this->user;
    }
}
