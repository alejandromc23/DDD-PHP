<?php

namespace Chaplin\Quote\Application\FindAll;

use Chaplin\Core\CommandBus\QueryHandlerInterface;

class FindAllQuotesHandler implements QueryHandlerInterface
{
    public function __construct(
        private AllQuotesFinder $allQuotesFinder
    ) {
    }

    public function handle(FindAllQuotesQuery $allQuotesQuery): array
    {
        return $this->allQuotesFinder->execute();
    }
}
