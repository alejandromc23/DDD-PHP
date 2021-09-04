<?php

namespace Chaplin\Controller;

use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Movie\Application\FindByTitle\FindByTitleQuery;
use Chaplin\Movie\Application\FindByTitle\FindByTitleResponse;
use Chaplin\User\Application\AddUserMovie\AddUserMovieCommand;
use Chaplin\User\Application\RateUserMovie\RateUserMovieCommand;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    public function __construct(
        private CommandBus $queryBus,
        private CommandBus $commandBus
    ) {
    }

    #[Route('/api/movies', methods: ['GET'])]
    public function findByTitle(Request $request): Response
    {
        $title = $request->query->get('title');

        /** @var FindByTitleResponse $movies */
        $movies = $this->queryBus->handle(
            new FindByTitleQuery($title)
        );

        return new Response(json_encode($movies->movies()));
    }

    #[Route('/api/movies/add', methods: ['POST'])]
    public function addUserMovie(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->getUser();
        $id = new Id($data['id']);

        $this->commandBus->handle(new AddUserMovieCommand($user, $id));

        return new Response('Movie added successfully! :)', 201);
    }

    #[Route('/api/movies/rate', methods: ['POST'])]
    public function rateUserMovie(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->getUser();
        $id = new Id($data['id']);
        $rating = (float) $data['rating'];

        $this->commandBus->handle(new RateUserMovieCommand($user, $id, $rating));

        return new Response('Movie rated successfully! :)', 201);
    }
}
