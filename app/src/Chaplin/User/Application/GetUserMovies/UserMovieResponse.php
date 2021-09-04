<?php

declare(strict_types=1);

namespace Chaplin\User\Application\GetUserMovies;

use Chaplin\Movie\Application\FindByTitle\MovieResponse;

final class UserMovieResponse implements \JsonSerializable
{
    public function __construct(
        private MovieResponse $movie,
        private ?float $rating
    ) {
    }

    public function movie(): MovieResponse
    {
        return $this->movie;
    }

    public function rating(): ?float
    {
        return $this->rating;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
