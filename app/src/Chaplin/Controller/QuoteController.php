<?php

namespace Chaplin\Controller;

use Chaplin\Quote\Application\FindAll\FindAllQuotesQuery;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    public function __construct(
        private CommandBus $queryBus
    ) {
    }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $allQuotes = $this->queryBus->handle(new FindAllQuotesQuery());

        return $this->render(
            'quote/index.html.twig',
            [
                'quotes' => $allQuotes,
            ]
        );
    }
}
