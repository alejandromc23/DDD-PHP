<?php


namespace Chaplin\Movie\Domain\Entity;


use Chaplin\Core\Domain\ValueObject\Id;
use DateTimeInterface;

class Movie
{
    public function __construct(
        private Id $id,
        private string $extId,
        private string $title,
        private DateTimeInterface $startDate,
        private ?int $duration
    )
    {
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

    public function startDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    public function duration(): ?int
    {
        return $this->duration;
    }
}