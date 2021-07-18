<?php

namespace Chaplin\Controller;

use Chaplin\User\Application\Create\CreateUserQuery;
use Chaplin\User\Domain\ValueObject\Email;
use Chaplin\User\Domain\ValueObject\Password;
use Chaplin\User\Domain\ValueObject\Username;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractController
{
    public function __construct(
        private CommandBus $commandBus
    ) {
    }

    public function register(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $email = new Email($data['email']);
        $username = new Username($data['username']);
        $password = new Password($data['password']);

        $this->commandBus->handle(new CreateUserQuery($email, $username, $password));

        return new Response(sprintf('User %s successfully created', $username), 201);
    }

    public function api(): Response
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}
