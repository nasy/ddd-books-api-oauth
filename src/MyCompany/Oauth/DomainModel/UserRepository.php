<?php

namespace MyCompany\Oauth\DomainModel;

interface UserRepository
{
    public function save(UserEntity $userEntity);
    public function getById(string $id) : UserEntity;
    public function doesUserExist(string $email) : bool;
}