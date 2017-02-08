<?php

namespace MyCompany\Book\Command;

use MyCompany\Book\DomainModel\BookEntity;

class UpdateBookCommand
{
    /** @var BookEntity */
    private $book;
    /** @var string */
    private $title;
    /** @var string */
    private $author;

    public function __construct(
        BookEntity $book,
        string $title = null,
        string $author = null
    ) {
        $this->book = $book;
        $this->title = $title;
        $this->author = $author;
    }

    /**
     * @return BookEntity
     */
    public function book() : BookEntity
    {
        return $this->book;
    }

    /**
     * @return string
     */
    public function title() : ?string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function author() : ?string
    {
        return $this->author;
    }
}
