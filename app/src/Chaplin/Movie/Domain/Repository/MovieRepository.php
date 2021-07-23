<?php


namespace Chaplin\Movie\Domain\Repository;


interface MovieRepository
{
    public  function findByTitleLike(string $title): array;
}