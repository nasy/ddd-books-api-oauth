<?php

namespace MyCompany\Book\Command;

use MyCompany\Book\DomainModel\BookEntity;

class DeleteBookCommand
{
    /** @var BookEntity */
    private $book;

    public function __construct(
        BookEntity $book
    ) {
        $this->book = $book;
    }

    /**
     * @return BookEntity
     */
    public function book() : BookEntity
    {
        return $this->book;
    }
}
