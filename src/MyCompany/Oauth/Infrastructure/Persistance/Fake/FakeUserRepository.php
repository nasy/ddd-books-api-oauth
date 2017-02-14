<?php

namespace MyCompany\Oauth\Infrastructure\Persistance\Fake;

use MyCompany\Oauth\DomainModel\UserRepository;
use MyCompany\Oauth\DomainModel\UserEntity;

class FakeUserRepository implements UserRepository
{
    public function save(UserEntity $userEntity)
    {
        return null;
    }

    public function getById(string $id) : UserEntity
    {
        return new UserEntity();
    }

    public function doesUserExist(string $email) :bool
    {
        return false;
    }
}
