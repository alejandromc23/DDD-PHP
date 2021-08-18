<?php
declare(strict_types=1);

namespace Chaplin\User\Application\AddUserMovie;

use Chaplin\Core\Domain\ValueObject\Id;

final class AddUserMovieQuery
{
    private Id $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }
}