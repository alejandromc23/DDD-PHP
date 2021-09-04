<?php

declare(strict_types=1);

namespace Chaplin\Movie\Application\FindByTitle;

final class FindByTitleResponse
{
    public function __construct(
        private array $movies
    ) {
    }

    public function movies(): array
    {
        return $this->movies;
    }
}
