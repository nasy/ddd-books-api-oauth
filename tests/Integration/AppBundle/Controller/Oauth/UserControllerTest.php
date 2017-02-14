<?php

namespace tests\Integration\AppBundle\Controller\Oauth;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class UserControllerTest extends WebTestCase
{
    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->client = $this->makeClient();
    }

    public function testPostUser()
    {
        $route =  $this->getUrl('api_1_post_user');
        $this->client->request(
            'POST',
            $route,
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"email":"user2@test.com","password":"1234"}'
        );
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $this->assertTrue(is_array($decoded));
        $this->assertInternalType('string', $decoded['data']['id']);
    }
}
