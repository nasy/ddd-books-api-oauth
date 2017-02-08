<?php

namespace MyCompany\Book\DomainModel;

use MyCompany\Book\DomainModel\BookEntity;

interface BookRepository
{
    public function save(BookEntity $bookEntity);
    public function delete(BookEntity $bookEntity);
    public function getById(string $id);
    public function getAll(int $limit = 25, int $offset = 0);
}