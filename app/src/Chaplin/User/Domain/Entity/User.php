<?php

namespace Chaplin\User\Domain\Entity;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Movie\Domain\Entity\Movie;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private Id $id;

    private string $email;

    private string $username;

    private array $roles;

    private string $password;

    /** @var Movie[] */
    private array $movies;

    public function __construct(
        Id $id,
        string $email,
        string $username
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->roles = ['ROLE_USER'];
        $this->movies = [];
    }

    public function addRole($role)
    {
        $role = strtoupper($role);
        if ('ROLE_USER' !== $role && !in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function username(): string
    {
        return $this->username;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function movies(): array
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): void
    {
        $this->movies[] = $movie;
    }
}
