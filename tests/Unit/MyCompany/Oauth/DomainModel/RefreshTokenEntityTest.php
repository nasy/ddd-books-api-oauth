<?php

namespace tests\Unit\MyCompany\Oauth\DomainModel;

use MyCompany\Oauth\DomainModel\ClientEntity;
use MyCompany\Oauth\DomainModel\RefreshTokenEntity;
use MyCompany\Oauth\DomainModel\UserEntity;

class RefreshTokenEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $class = new RefreshTokenEntity();
        $this->assertSame(RefreshTokenEntity::class, get_class($class));
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
        $user = new RefreshTokenEntity();
        $this->assertObjectHasAttribute($attribute, $user);
    }

    public function testCreate()
    {
        $class = new RefreshTokenEntity();
        $class->setClient(new ClientEntity());
        $class->setUser(new UserEntity());
        $this->assertSame(RefreshTokenEntity::class, get_class($class));
        // Name
        $this->assertNotEmpty($class->getClient());
        $this->assertInstanceOf(ClientEntity::class, $class->getClient());
    }
}