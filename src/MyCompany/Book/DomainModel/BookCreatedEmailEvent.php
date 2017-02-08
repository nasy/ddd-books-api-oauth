<?php

namespace MyCompany\Book\DomainModel;

class BookCreatedEmailEvent
{
    /** @var BookEntity */
    private $bookEntity;

    public function __construct($bookEntity)
    {
        $this->bookEntity = $bookEntity;
    }

    public function bookEntity()
    {
        return $this->bookEntity;
    }
}
