<?php

namespace tests\Unit\MyCompany\Oauth\DomainModel;

use MyCompany\Oauth\DomainModel\ClientEntity;
use MyCompany\Oauth\DomainModel\AccessTokenEntity;
use MyCompany\Oauth\DomainModel\UserEntity;

class AccessTokenEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $class = new AccessTokenEntity();
        $this->assertSame(AccessTokenEntity::class, get_class($class));
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
        $user = new AccessTokenEntity();
        $this->assertObjectHasAttribute($attribute, $user);
    }

    public function testCreate()
    {
        $class = new AccessTokenEntity();
        $class->setClient(new ClientEntity());
        $class->setUser(new UserEntity());
        $this->assertSame(AccessTokenEntity::class, get_class($class));
        // Name
        $this->assertNotEmpty($class->getClient());
        $this->assertInstanceOf(ClientEntity::class, $class->getClient());
    }
}