<?php
namespace MyCompany\Oauth\Command;

use MyCompany\Identity\DomainModel\EntityID;

class CreateUserCommand
{
    /** @var EntityID */
    private $id;
    /** @var string */
    private $email;
    /** @var string */
    private $password;

    public function __construct(
        EntityID $id,
        string $email,
        string $password
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return EntityID
     */
    public function id() : EntityID
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function email() : ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password() : ?string
    {
        return $this->password;
    }
}
