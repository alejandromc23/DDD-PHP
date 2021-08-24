<?php

declare(strict_types=1);

namespace Chaplin\User\Application\AddUserMovie;

use Chaplin\Core\CommandBus\CommandHandlerInterface;
use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Movie\Domain\Repository\MovieRepository;
use Chaplin\Toolkit\IdGenerator\UuidGenerator;
use Chaplin\User\Domain\Entity\User;
use Chaplin\User\Domain\Entity\UserMovie;
use Chaplin\User\Domain\Exception\UserMovieAlreadyExistsException;
use Chaplin\User\Domain\Repository\UserMovieRepository;
use Chaplin\User\Domain\Repository\UserRepository;

final class AddUserMovieHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private MovieRepository $movieRepository,
        private UserMovieRepository $userMovieRepository
    ) {
    }

    public function handle(AddUserMovieCommand $command): void
    {
        /** @var User $user */
        $user = $command->user();
        $movie = $this->movieRepository->findById($command->movieId());
        $userHasMovie = !empty($this->userMovieRepository->getUserMovieByUserIdAndMovieId($user->id(), $command->movieId()));

        if ($userHasMovie) {
            throw new UserMovieAlreadyExistsException(sprintf('User "%s" already has the movie "%s" added', $user->username(), $movie->title()));
        }

        $userMovie = new UserMovie(new Id(UuidGenerator::generateId()), $user, $movie);
        $user->addUserMovie($userMovie);

        $this->userRepository->save($user);
    }
}
