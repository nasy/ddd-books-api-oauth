<?php

namespace MyCompany\Oauth\DomainModel;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

class ClientEntity extends BaseClient
{
    protected $id;
    protected $name;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

}