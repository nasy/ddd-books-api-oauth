<?php

namespace tests\Unit\MyCompany\Oauth\DomainModel;

use MyCompany\Oauth\DomainModel\UserEntity;
use MyCompany\Identity\Infrastructure\UUID;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $user = new UserEntity();
        $this->assertSame(UserEntity::class, get_class($user));
    }

    public function attributes()
    {
        return [
            ['id'],
            ['username'],
            ['email'],
            ['password'],
            ['createdAt']
        ];
    }

    /**
     * @param string $attribute
     * @dataProvider attributes
     */
    public function testStructure(string $attribute)
    {
        $user = new UserEntity();
        $this->assertObjectHasAttribute($attribute, $user);
    }

    public function testCreate()
    {
        $userEmail = 'test@test.com';
        $userPass = '1234';
        $id = UUID::create();
        $encoderFactory = new FakeEncoderFactory();
        $user = UserEntity::create($encoderFactory, $id, $userEmail, $userPass);
        $this->assertSame(UserEntity::class, get_class($user));
        // Id
        $this->assertNotEmpty($user->getId());
        $this->assertInternalType('string', $user->getId());
        $this->assertStringMatchesFormat('%x-%x-4%x-%x-%x', $user->getId());
        // Email
        $this->assertNotEmpty($user->getEmail());
        $this->assertInternalType('string', $user->getEmail());
        $this->assertSame($userEmail, $user->getEmail());
        // Email Canonical
        $this->assertNotEmpty($user->getEmailCanonical());
        $this->assertInternalType('string', $user->getEmailCanonical());
        $this->assertSame($userEmail, $user->getEmailCanonical());
        // Username
        $this->assertNotEmpty($user->getUsername());
        $this->assertInternalType('string', $user->getUsername());
        $this->assertSame($userEmail, $user->getUsername());
        // Email Canonical
        $this->assertNotEmpty($user->getUsernameCanonical());
        $this->assertInternalType('string', $user->getUsernameCanonical());
        $this->assertSame($userEmail, $user->getUsernameCanonical());
        // Password
        $this->assertNotEmpty($user->getPassword());
        $this->assertInternalType('string', $user->getPassword());
        $this->assertNotSame($userPass, $user->getPassword());

        // Created At
        $now = new \DateTime('now');
        $this->assertSame('DateTime', get_class($user->createdAt()));
        $this->assertEquals($now->getTimestamp(), $user->createdAt()->getTimestamp(), '', 10);
    }
}
class FakeEncoder{

    public function encodePassword(string $password,string $salt){
        return "encoded";
    }
}
class FakeEncoderFactory implements EncoderFactoryInterface{

    public function getEncoder($user){
        return new FakeEncoder();
    }
}
