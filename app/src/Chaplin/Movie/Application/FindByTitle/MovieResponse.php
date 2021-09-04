<?php

declare(strict_types=1);

namespace Chaplin\Movie\Application\FindByTitle;

final class MovieResponse implements \JsonSerializable
{
    private int $year;

    public function __construct(
        private string $id,
        private string $title,
        private ?int $duration,
        \DateTimeInterface $year,
    ) {
        $this->year = (int) $year->format('Y');
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function duration(): ?int
    {
        return $this->duration;
    }

    public function year(): int
    {
        return $this->year;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
