<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Book\DomainModel\BookCreatedEmailInterface;
use MyCompany\Book\Infrastructure\Communications\Fake\FakeBookCreatedEmail;
use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Identity\Infrastructure\UUID;

class BookCreatedEmailInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /** @var  FakeBookCreatedEmail */
    private $fakeBookCreatedEmail;

    public function setUp()
    {
        $this->fakeBookCreatedEmail = new FakeBookCreatedEmail('');
    }

    public function testClassExists()
    {
        self::assertInstanceOf(BookCreatedEmailInterface::class, $this->fakeBookCreatedEmail);
    }

    public function testSendMethod()
    {
        $this->fakeBookCreatedEmail->send(BookEntity::create(UUID::create(), '', ''));
        self::assertTrue(true);
    }
}
