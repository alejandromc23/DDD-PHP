<?php

namespace Chaplin\User\Application\Create;

use Chaplin\Core\CommandBus\CommandHandlerInterface;
use Chaplin\Core\Domain\ValueObject\Id;
use Chaplin\Toolkit\IdGenerator\UuidGenerator;
use Chaplin\User\Domain\Entity\User;
use Chaplin\User\Domain\Exception\UserDataAlreadyExistsException;
use Chaplin\User\Domain\Repository\UserRepository;
use Chaplin\User\Domain\ValueObject\Email;
use Chaplin\User\Domain\ValueObject\Username;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordEncoderInterface $encoder
    ) {
    }

    public function handle(CreateUserQuery $userQuery): void
    {
        $this->validateUserData($userQuery->email(), $userQuery->username());

        $user = new User(new Id(UuidGenerator::generateId()), $userQuery->email()->email(), $userQuery->username()->username());

        $user->setPassword($this->encoder->encodePassword($user, $userQuery->password()));

        $this->userRepository->save($user);
    }

    /**
     * @throws UserDataAlreadyExistsException
     */
    private function validateUserData(Email $email, Username $username): void
    {
        $user = $this->userRepository->getByEmail($email);

        if (!empty($user)) {
            throw new UserDataAlreadyExistsException(sprintf('User with email %s already exists', $email->email()));
        }

        $user = $this->userRepository->getByUsername($username);

        if (!empty($user)) {
            throw new UserDataAlreadyExistsException(sprintf('User with username %s already exists', $username->username()));
        }
    }
}
