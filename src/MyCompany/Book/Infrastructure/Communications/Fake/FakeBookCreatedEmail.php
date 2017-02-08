<?php

namespace MyCompany\Book\Infrastructure\Communications\Fake;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookCreatedEmailInterface;

class FakeBookCreatedEmail implements BookCreatedEmailInterface
{
    public function send(BookEntity $bookEntity)
    {
        return null;
    }
}