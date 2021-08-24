<?php

declare(strict_types=1);

namespace Chaplin\User\Application\RateUserMovie;

use Chaplin\Core\CommandBus\CommandHandlerInterface;
use Chaplin\User\Domain\Entity\User;
use Chaplin\User\Domain\Exception\UserMovieNotFoundException;
use Chaplin\User\Domain\Repository\UserMovieRepository;

final class RateUserMovieHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserMovieRepository $userMovieRepository
    ) {
    }

    public function handle(RateUserMovieCommand $command): void
    {
        /** @var User $user */
        $user = $command->user();
        $userMovie = $this->userMovieRepository->getUserMovieByUserIdAndMovieId($user->id(), $command->movieId());

        if (empty($userMovie)) {
            throw new UserMovieNotFoundException('This movie does not exist inside user\'s list.');
        }

        $userMovie->setRating($command->rating());

        $this->userMovieRepository->save($userMovie);
    }
}
