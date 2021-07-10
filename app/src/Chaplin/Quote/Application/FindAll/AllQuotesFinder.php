<?php


namespace Chaplin\Quote\Application\FindAll;


use Chaplin\Quote\Domain\Repository\QuoteRepository;

class AllQuotesFinder
{
    public function __construct(
        private QuoteRepository $quoteRepository
    )
    {
    }

    public function execute(): array
    {
        return $this->quoteRepository->findAll();
    }
}