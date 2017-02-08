<?php

namespace MyCompany\Book\Command;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookRepository;
use MyCompany\Book\DomainModel\BookCreatedEmailEvent;

use SimpleBus\Message\Bus\MessageBus;

class CreateBookCommandHandler
{
    /** @var BookRepository */
    private $bookRepository;
    /** @var MessageBus */
    private $eventBus;

    public function __construct(
        BookRepository $bookRepository,
        MessageBus $eventBus
    ) {
        $this->bookRepository = $bookRepository;
        $this->eventBus = $eventBus;
    }
    /**
     * @param CreateBookCommand $command
     */
    public function handle(CreateBookCommand $command)
    {
        $bookEntity = BookEntity::create(
            $command->id(),
            $command->title(),
            $command->author()
        );
        $this->bookRepository->save($bookEntity);

        /* Send book has been created email */
        $bookCreatedEmailEvent = new BookCreatedEmailEvent($bookEntity);
        $this->eventBus->handle($bookCreatedEmailEvent);
    }
}
