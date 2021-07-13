<?php


namespace Chaplin\User\Application\Create;


use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\User\Domain\ValueObject\Email;
use Chaplin\User\Domain\ValueObject\Username;

class CreateUserQuery
{
    public function __construct(
        private Email $email,
        private Username $username,
        private string $password
    )
    {
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function username(): Username
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }
}