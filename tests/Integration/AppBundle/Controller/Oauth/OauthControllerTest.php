<?php

namespace tests\Integration\AppBundle\Controller\Oauth;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class OauthControllerTest extends WebTestCase
{
    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->client = $this->makeClient();
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\Oauth\UserData'
        ]);
    }

    public function testGetAccessToken()
    {
        $clientManager =  $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setName('User Access');
        $client->setRedirectUris(array('http://www.example.com'));
        $client->setAllowedGrantTypes(array('refresh_token', 'password'));
        //   $client->setAllowedGrantTypes(array('token', 'refresh_token', 'client_credentials', 'authorization_code', 'password'));
        $client->setSecret($client->getSecret());
        $client->setRandomId($client->getRandomId());

        $clientManager->updateClient($client);

        $route =  $this->getUrl('fos_oauth_server_token');
        $this->client->request(
            'GET',
            $route,
            [
                'client_id' =>  $client->getPublicId(),
                'client_secret' => $client->getSecret(),
                'grant_type' => 'password',
                'username' => 'test@test.com',
                'password' => '1234'
            ],
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"email":"test@test.com","password":"1234"}'
        );
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $this->assertTrue(is_array($decoded));

        $this->assertNotEmpty($decoded['access_token']);
        $this->assertInternalType('string', $decoded['access_token']);

        $this->assertNotEmpty($decoded['expires_in']);
        $this->assertInternalType('int', $decoded['expires_in']);

        $this->assertNotEmpty($decoded['token_type']);
        $this->assertInternalType('string', $decoded['token_type']);
        $this->assertEquals("bearer", $decoded['token_type']);

        $this->assertNull($decoded['scope']);

        $this->assertNotEmpty($decoded['refresh_token']);
        $this->assertInternalType('string', $decoded['refresh_token']);
    }
}
