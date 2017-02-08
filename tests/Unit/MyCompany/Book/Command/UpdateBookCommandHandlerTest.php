<?php

namespace tests\Unit\MyCompany\Book\Command;

use MyCompany\Identity\Infrastructure\UUID;
use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\Command\UpdateBookCommand;
use MyCompany\Book\Command\UpdateBookCommandHandler;
use MyCompany\Book\Infrastructure\Persistance\Fake\FakeBookRepository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UpdateBookCommandHandlerTest extends WebTestCase
{
    /** @var UpdateBookCommandHandler */
    private $commandHandler;

    public function setUp()
    {
        $bookRepository = new FakeBookRepository();
        $this->commandHandler = new UpdateBookCommandHandler(
            $bookRepository
        );
    }

    public function testCommand()
    {
        $bookEntity = BookEntity::create(UUID::create(), '', '');
        $this->commandHandler->handle(new UpdateBookCommand(
            $bookEntity,
            'TITLE',
            'AUTHOR'
        ));
        // if exception is thrown never reaches the assert null.
        static::assertNull(null);
    }
}