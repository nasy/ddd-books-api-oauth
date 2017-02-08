<?php

namespace MyCompany\Book\Command;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookRepository;

class DeleteBookCommandHandler
{
    /** @var BookRepository */
    private $bookRepository;

    public function __construct(
        BookRepository $bookRepository
    ) {
        $this->bookRepository = $bookRepository;
    }
    /**
     * @param DeleteBookCommand $command
     */
    public function handle(DeleteBookCommand $command)
    {
        $this->bookRepository->delete($command->book());
    }
}
