<?php

namespace tests\Unit\MyCompany\Oauth\DomainModel;

use MyCompany\Oauth\DomainModel\ClientEntity;

class ClientEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $client = new ClientEntity();
        $this->assertSame(ClientEntity::class, get_class($client));
    }

    public function attributes()
    {
        return [
            ['id'],
            ['name']
        ];
    }

    /**
     * @param string $attribute
     * @dataProvider attributes
     */
    public function testStructure(string $attribute)
    {
        $user = new ClientEntity();
        $this->assertObjectHasAttribute($attribute, $user);
    }

    public function testCreate()
    {
        $clientName = 'test';
        $client = new ClientEntity();
        $client->setName($clientName);
        $this->assertSame(ClientEntity::class, get_class($client));
        // Name
        $this->assertNotEmpty($client->getName());
        $this->assertInternalType('string', $client->getName());
        $this->assertSame($clientName, $client->getName());
    }
}