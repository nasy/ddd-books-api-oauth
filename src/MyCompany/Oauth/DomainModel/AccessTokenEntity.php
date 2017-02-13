<?php

namespace MyCompany\Oauth\DomainModel;

use FOS\OAuthServerBundle\Document\AccessToken as BaseAccessToken;
use FOS\OAuthServerBundle\Model\ClientInterface;

class AccessTokenEntity extends BaseAccessToken
{
    protected $id;
    protected $client;
    protected $user;

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getUser()
    {
        return $this->user;
    }
}