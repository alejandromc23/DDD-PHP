<?php

namespace Chaplin\Controller;

use Chaplin\Movie\Application\FindByTitle\FindByTitleQuery;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    public function __construct(
        private CommandBus $queryBus
    ) {
    }

    #[Route('/api/movies', methods: ['GET'])]
    public function register(Request $request): Response
    {
        $title = $request->query->get('title');

        $movies = $this->queryBus->handle(
            new FindByTitleQuery($title)
        );

        return new Response(json_encode($movies));
    }
}