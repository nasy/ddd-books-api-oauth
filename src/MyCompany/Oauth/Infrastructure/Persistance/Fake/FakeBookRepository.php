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

    public function getById(string $id)
    {
        return new UserEntity();
    }

    public function getAll(int $limit = null, int $offset = null)
    {
        return [new UserEntity()];
    }
}
