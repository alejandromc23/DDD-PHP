<?php

namespace Chaplin\Movie\Domain\Repository;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Movie\Domain\Entity\Movie;

interface MovieRepository
{
    public function findById(Id $id): Movie;

    public function findByTitleLike(string $title): array;
}
