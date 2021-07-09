<?php

namespace Chaplin\Controller;

use Chaplin\Quote\Infrastructure\Repository\QuoteRepositoryDoctrine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(QuoteRepositoryDoctrine $quoteRepository): Response
    {
        return $this->render(
            'quote/index.html.twig',
            [
                'quotes' => $quoteRepository->findAll(),
            ]
        );
    }
}
