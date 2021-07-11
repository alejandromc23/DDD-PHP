<?php


namespace Chaplin\User\Domain\ValueObject;



use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

class Email
{
    private string $email;

    public function __construct(
        string $email
    )
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid email.', $email));
        }

        $this->email = $email;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    private function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}