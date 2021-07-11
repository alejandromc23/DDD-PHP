<?php


namespace Chaplin\Controller;


use Chaplin\User\Domain\Entity\User;
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

        $email = $data['email'];
        $username = $data['username'];
        $password = $data['password'];

        $user = new User(2, $email, $username);
        $user->setPassword($encoder->encodePassword($user, $password));

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()), 201);
    }

    public function api(): Response
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}