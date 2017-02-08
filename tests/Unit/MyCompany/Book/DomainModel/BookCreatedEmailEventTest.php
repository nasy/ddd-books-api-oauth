<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Book\DomainModel\BookCreatedEmailEvent;
use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Identity\Infrastructure\UUID;

class BookCreatedEmailEventTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $bookEntity = BookEntity::create(UUID::create(), '', '');
        self::assertInstanceOf(BookCreatedEmailEvent::class, new BookCreatedEmailEvent($bookEntity));
    }

    public function testEvent()
    {
        $bookEntity = BookEntity::create(UUID::create(), '', '');
        $bookCreatedEmailEvent = new BookCreatedEmailEvent($bookEntity);

        static::assertNotEmpty($bookCreatedEmailEvent->bookEntity());
        self::assertInstanceOf(BookEntity::class, $bookCreatedEmailEvent->bookEntity());
    }
}
