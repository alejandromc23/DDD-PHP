<?php

namespace Chaplin\Movie\Domain\Entity;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\User\Domain\Entity\User;
use DateTimeInterface;

class Movie
{
    private array $users;

    public function __construct(
        private Id $id,
        private string $extId,
        private string $title,
        private DateTimeInterface $year,
        private ?int $duration
    ) {
        $this->users = [];
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function extId(): string
    {
        return $this->extId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function year(): DateTimeInterface
    {
        return $this->year;
    }

    public function duration(): ?int
    {
        return $this->duration;
    }

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }
}
