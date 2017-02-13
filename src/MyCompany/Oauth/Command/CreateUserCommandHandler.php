<?php

namespace MyCompany\Oauth\Command;

use MyCompany\Oauth\DomainModel\UserEntity;
use MyCompany\Oauth\DomainModel\UserRepository;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use MyCompany\Oauth\DomainModel\UserAlreadyExistsException;

use SimpleBus\Message\Bus\MessageBus;

class CreateUserCommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var MessageBus */
    private $eventBus;
    /** @var EncoderFactory */
    private $encoderFactory;

    public function __construct(
        UserRepository $userRepository,
        MessageBus $eventBus,
        EncoderFactory $encoderFactory
    ) {
        $this->userRepository = $userRepository;
        $this->eventBus = $eventBus;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param CreateUserCommand $command
     * @throws UserAlreadyExistsException
     */
    public function handle(CreateUserCommand $command)
    {
        if($this->userRepository->doesUserExist($command->email())){
            throw new UserAlreadyExistsException("USER_ALREADY_EXISTS");
        }
        $userEntity = UserEntity::create(
            $this->encoderFactory,
            $command->id(),
            $command->email(),
            $command->password()
        );
        $this->userRepository->save($userEntity);
    }
}
