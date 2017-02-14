<?php

namespace tests\Unit\MyCompany\Oauth\DomainModel;

use MyCompany\Oauth\DomainModel\ClientEntity;
use MyCompany\Oauth\DomainModel\AuthCodeEntity;
use MyCompany\Oauth\DomainModel\UserEntity;

class AuthCodeEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $class = new AuthCodeEntity();
        $this->assertSame(AuthCodeEntity::class, get_class($class));
    }

    public function attributes()
    {
        return [
            ['id'],
            ['user'],
            ['client'],
        ];
    }

    /**
     * @param string $attribute
     * @dataProvider attributes
     */
    public function testStructure(string $attribute)
    {
        $user = new AuthCodeEntity();
        $this->assertObjectHasAttribute($attribute, $user);
    }

    public function testCreate()
    {
        $class = new AuthCodeEntity();
        $class->setClient(new ClientEntity());
        $class->setUser(new UserEntity());
        $this->assertSame(AuthCodeEntity::class, get_class($class));
        // Name
        $this->assertNotEmpty($class->getClient());
        $this->assertInstanceOf(ClientEntity::class, $class->getClient());
    }
}