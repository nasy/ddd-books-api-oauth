<?php

namespace tests\Unit\MyCompany\Oauth\Command;

use MyCompany\Oauth\Command\CreateUserCommand;
use MyCompany\Oauth\Command\CreateUserCommandHandler;
use MyCompany\Oauth\Infrastructure\Persistance\Fake\FakeUserRepository;
use MyCompany\Identity\Infrastructure\UUID;

use SimpleBus\Message\Bus\MessageBus;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class CreateUserCommandHandlerTest extends WebTestCase
{
    /** @var CreateUserCommandHandler */
    private $commandHandler;

    public function setUp()
    {
        $userRepository = new FakeUserRepository();
        $this->commandHandler = new CreateUserCommandHandler(
            $userRepository,
            new FakeMessageBus(),
            new FakeEncoderFactory()
        );
    }

    public function testCommand()
    {
        $this->commandHandler->handle(new CreateUserCommand(
            UUID::create(),
            'test@test.com',
            '1234'
        ));
        // if exception is thrown never reaches the assert null.
        static::assertNull(null);
    }
}
class FakeMessageBus implements MessageBus
{
    public function handle($message)
    {
        return null;
    }
}
class FakeEncoder{

    public function encodePassword(string $password,string $salt){
        return "encoded";
    }
}
class FakeEncoderFactory implements EncoderFactoryInterface{

    public function getEncoder($user){
        return new FakeEncoder();
    }
}
