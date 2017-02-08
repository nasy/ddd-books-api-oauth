<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Book\Infrastructure\Communications\Fake\FakeBookCreatedEmail;
use MyCompany\Book\DomainModel\BookCreatedEmailEvent;
use MyCompany\Book\DomainModel\BookCreatedEmailListener;
use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Identity\Infrastructure\UUID;

class BookCreatedEmailListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testListener()
    {
        $fakeBookCreatedEmail = new FakeBookCreatedEmail();
        $bookCreatedListener = new BookCreatedEmailListener($fakeBookCreatedEmail);
        self::assertInstanceOf(BookCreatedEmailListener::class, $bookCreatedListener);

        $bookEntity = BookEntity::create(UUID::create(), '', '');
        $bookCreatedEmailEvent = new BookCreatedEmailEvent($bookEntity);
        $bookCreatedListener->notify($bookCreatedEmailEvent);
        self::assertTrue(true);
    }
}
