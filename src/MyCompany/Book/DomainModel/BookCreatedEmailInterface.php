<?php

namespace MyCompany\Book\DomainModel;

interface BookCreatedEmailInterface
{
    public function send(BookEntity $bookEntity);
}
