<?php

namespace Chaplin\Controller;

use Chaplin\Core\Domain\ValueObject\Id;
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
    public function find(Request $request): Response
    {
        $title = $request->query->get('title');

        $movies = $this->queryBus->handle(
            new FindByTitleQuery($title)
        );

        return new Response(json_encode($movies));
    }

    #[Route('/api/movies/add', methods: ['POST'])]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $id = new Id($data['id']);

        return new Response('Movie added successfully! :)', 201);
    }
}
