<?php

declare(strict_types=1);

namespace Chaplin\User\Application\GetUserMovies;

use Chaplin\Core\CommandBus\QueryHandlerInterface;
use Chaplin\Movie\Application\FindByTitle\MovieResponse;
use Chaplin\User\Domain\Entity\User;
use Chaplin\User\Domain\Entity\UserMovie;
use Chaplin\User\Domain\Repository\UserMovieRepository;

final class GetUserMoviesHandler implements QueryHandlerInterface
{
    public function __construct(
        private UserMovieRepository $userMovieRepository
    ) {
    }

    public function handle(GetUserMoviesQuery $query): GetUserMoviesResponse
    {
        /** @var User $user */
        $user = $query->user();
        $userMovies = $this->userMovieRepository->getUserMoviesByUserId($user->id());

        return new GetUserMoviesResponse($this->formatUserMovies($userMovies));
    }

    private function formatUserMovies(array $userMovies): array
    {
        return array_map(function (UserMovie $userMovie) {
            return new UserMovieResponse(
                new MovieResponse(
                    $userMovie->movie()->id()->id(),
                    $userMovie->movie()->title(),
                    $userMovie->movie()->duration(),
                    $userMovie->movie()->year()
                ),
                $userMovie->rating()
            );
        }, $userMovies);
    }
}
