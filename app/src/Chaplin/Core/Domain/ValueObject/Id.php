<?php


namespace Chaplin\Core\Domain\ValueObject;


use JetBrains\PhpStorm\Pure;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

class Id
{
    private string $id;

    public function __construct(string $id)
    {
        if (!$this->isValidUuid($id)) {
            throw new InvalidArgumentException(sprintf('Invalid uuid format: %s', $id));
        }

        $this->id = $id;
    }

    public static function fromOldId($id): self
    {
        return new self($id->id());
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public function id(): string
    {
        return $this->id;
    }

    #[Pure] public function equals(string $id): bool
    {
        return $this->id() === $id;
    }

    #[Pure] public function __toString(): string
    {
        return $this->id();
    }

    private function isValidUuid($inputStringId): bool
    {
        return 1 === preg_match('/([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})/', $inputStringId);
    }
}