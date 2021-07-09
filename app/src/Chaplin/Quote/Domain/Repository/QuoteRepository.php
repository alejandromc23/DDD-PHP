<?php


namespace Chaplin\Quote\Domain\Repository;


interface QuoteRepository
{
    public function findAll(): array;
}