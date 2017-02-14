<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Oauth\DomainModel\UserNotFoundException;

class UserNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $exception = new UserNotFoundException();
        $this->assertSame(UserNotFoundException::class, get_class($exception));
    }
}