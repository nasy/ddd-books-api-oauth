<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Oauth\DomainModel\UserAlreadyExistsException;

class UserAlreadyExistsExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $exception = new UserAlreadyExistsException();
        $this->assertSame(UserAlreadyExistsException::class, get_class($exception));
    }
}