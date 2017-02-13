<?php

namespace MyCompany\Oauth\DomainModel;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use FOS\OAuthServerBundle\Model\ClientInterface;

class RefreshTokenEntity extends BaseRefreshToken
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
}