<?php

declare(strict_types=1);

namespace Chaplin\Controller;

use Chaplin\User\Application\GetUserMovies\GetUserMoviesQuery;
use Chaplin\User\Application\GetUserMovies\GetUserMoviesResponse;
use Chaplin\User\Domain\Entity\User;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserController extends AbstractController
{
    public function __construct(
        private CommandBus $queryBus
    ) {
    }

    #[Route('/api/user/movies', methods: ['GET'])]
    public function getUserMovies(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        /** @var GetUserMoviesResponse $userMovies */
        $userMovies = $this->queryBus->handle(
            new GetUserMoviesQuery($user)
        );

        return new Response(json_encode($userMovies->userMovies()));
    }
}
