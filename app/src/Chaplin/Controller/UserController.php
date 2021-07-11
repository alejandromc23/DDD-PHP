<?php


namespace Chaplin\Controller;


use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Toolkit\IdGenerator\UuidGenerator;
use Chaplin\User\Domain\Entity\User;
use Chaplin\User\Domain\ValueObject\Email;
use Chaplin\User\Domain\ValueObject\Password;
use Chaplin\User\Domain\ValueObject\Username;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $em = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $email = new Email($data['email']);
        $username = new Username($data['username']);
        $password = new Password($data['password']);

        $user = new User(new Id(UuidGenerator::generateId()), $email, $username);
        $user->setPassword($encoder->encodePassword($user, $password->password()));

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()), 201);
    }

    public function api(): Response
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}