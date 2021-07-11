<?php


namespace Chaplin\User\Domain\ValueObject;


use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

class Username
{
    private string $username;

    public function __construct(
        string $username
    )
    {
        if (!$this->isValidUsername($username)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid username.', $username));
        }
        $this->username = $username;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function __toString(): string
    {
        return $this->username;
    }

    private function isValidUsername(string $username): bool
    {
        return preg_match('/^[a-z\d_]{5,20}$/i', $username);
    }
}