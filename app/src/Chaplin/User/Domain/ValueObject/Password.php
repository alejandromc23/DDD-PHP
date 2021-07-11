<?php


namespace Chaplin\User\Domain\ValueObject;


use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

class Password
{
    private string $password;

    public function __construct(
        string $password
    )
    {
        if (!$this->isValidPassword($password)) {
            throw new InvalidArgumentException('Password must contain at least 1 digit, 1 upper case, 1 lower and a minimum of 8 characters');
        }
        $this->password = $password;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function __toString(): string
    {
        return $this->password;
    }

    private function isValidPassword(string $password): bool
    {
        return preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', $password);
    }
}