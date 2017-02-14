<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Oauth\Infrastructure\Persistance\Fake\FakeUserRepository;
use MyCompany\Oauth\DomainModel\UserRepository;

class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $book = new FakeUserRepository();
        $this->assertInstanceOf(UserRepository::class, $book);
    }
}
