<?php

declare(strict_types=1);

namespace Chaplin\User\Domain\Entity;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Movie\Domain\Entity\Movie;

final class UserMovie
{
    private ?float $rating;
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;

    public function __construct(
        private Id $id,
        private User $user,
        private Movie $movie
    ) {
        $this->rating = null;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function movie(): Movie
    {
        return $this->movie;
    }

    public function rating(): ?float
    {
        return $this->rating;
    }

    public function createdAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function updateTimestamps(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
