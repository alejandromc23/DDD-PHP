<?php


namespace Chaplin\Movie\Application\FindByTitle;


use Chaplin\Core\CommandBus\QueryHandlerInterface;
use Chaplin\Movie\Domain\Repository\MovieRepository;

class FindByTitleHandler implements QueryHandlerInterface
{
    public function __construct(
        private MovieRepository $movieRepository
    )
    {
    }

    public function handle(FindByTitleQuery $query): array
    {
        return $this->movieRepository->findByTitleLike($query->title());
    }
}