<?php

namespace MyCompany\Book\Infrastructure\Communications\SparkPost;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookCreatedEmailInterface;

class SparkPostBookCreatedEmail implements BookCreatedEmailInterface
{
    public function send(BookEntity $bookEntity)
    {
        // SEND HERE YOUR SPARKPOST EMAIL
        return null;
    }
}