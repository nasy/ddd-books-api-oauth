<?php

namespace MyCompany\Book\Command;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookRepository;

class UpdateBookCommandHandler
{
    /** @var BookRepository */
    private $bookRepository;

    public function __construct(
        BookRepository $bookRepository
    ) {
        $this->bookRepository = $bookRepository;
    }
    /**
     * @param UpdateBookCommand $command
     */
    public function handle(UpdateBookCommand $command)
    {
        $bookEntity = $command->book();
        $bookEntity->update(
            $command->title(),
            $command->author()
        );
        $this->bookRepository->save($bookEntity);
    }
}
