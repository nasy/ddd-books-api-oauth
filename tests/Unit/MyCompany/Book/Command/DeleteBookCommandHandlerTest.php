<?php

namespace tests\Unit\MyCompany\Book\Command;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\Command\DeleteBookCommand;
use MyCompany\Book\Command\DeleteBookCommandHandler;
use MyCompany\Book\Infrastructure\Persistance\Fake\FakeBookRepository;
use MyCompany\Identity\Infrastructure\UUID;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeleteBookCommandHandlerTest extends WebTestCase
{
    /** @var DeleteBookCommandHandler */
    private $commandHandler;

    public function setUp()
    {
        $bookRepository = new FakeBookRepository();
        $this->commandHandler = new DeleteBookCommandHandler(
            $bookRepository
        );
    }

    public function testCommand()
    {
        $bookEntity = BookEntity::create(UUID::create(), '', '');
        $this->commandHandler->handle(new DeleteBookCommand(
            $bookEntity
        ));
        // if exception is thrown never reaches the assert null.
        static::assertNull(null);
    }
}