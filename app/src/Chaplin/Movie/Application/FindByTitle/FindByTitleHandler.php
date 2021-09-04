<?php

namespace Chaplin\Movie\Application\FindByTitle;

use Chaplin\Core\CommandBus\QueryHandlerInterface;
use Chaplin\Movie\Domain\Entity\Movie;
use Chaplin\Movie\Domain\Repository\MovieRepository;

class FindByTitleHandler implements QueryHandlerInterface
{
    public function __construct(
        private MovieRepository $movieRepository
    ) {
    }

    public function handle(FindByTitleQuery $query): FindByTitleResponse
    {
        $movies = $this->movieRepository->findByTitleLike($query->title());

        return new FindByTitleResponse($this->formatMovies($movies));
    }

    public function formatMovies(array $movies): array
    {
        return array_map(function (Movie $movie) {
            return new MovieResponse(
                    $movie->id()->id(),
                    $movie->title(),
                    $movie->duration(),
                    $movie->year()
            );
        }, $movies);
    }
}
