<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Book\Infrastructure\Persistance\Fake\FakeBookRepository;
use MyCompany\Book\DomainModel\BookRepository;

class BookRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $book = new FakeBookRepository();
        $this->assertInstanceOf(BookRepository::class, $book);
    }
}
