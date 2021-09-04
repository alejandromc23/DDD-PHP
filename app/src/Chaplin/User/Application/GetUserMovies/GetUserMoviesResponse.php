<?php

declare(strict_types=1);

namespace Chaplin\User\Application\GetUserMovies;

final class GetUserMoviesResponse
{
    public function __construct(
        private array $userMovies
    ) {
    }

    public function userMovies(): array
    {
        return $this->userMovies;
    }
}
