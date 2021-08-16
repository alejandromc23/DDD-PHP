<?php

namespace Chaplin\Movie\Domain\Entity;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\User\Domain\Entity\UserMovie;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use JetBrains\PhpStorm\Pure;

class Movie
{
    private ArrayCollection $userMovies;

    #[Pure]
 public function __construct(
        private Id $id,
        private string $extId,
        private string $title,
        private DateTimeInterface $year,
        private ?int $duration
    ) {
     $this->userMovies = new ArrayCollection();
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

    #[Pure]
 public function userMovies(): array
 {
     return $this->userMovies->toArray();
 }

    public function addUserMovie(UserMovie $userMovie): void
    {
        $this->userMovies->add($userMovie);
    }
}
