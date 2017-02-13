<?php

namespace MyCompany\Oauth\Infrastructure\Persistance\Doctrine;

use MyCompany\Oauth\DomainModel\UserRepository as UserRepositoryInterface;
use MyCompany\Oauth\DomainModel\UserEntity;
use Doctrine\ORM\EntityManager;
use MyCompany\Oauth\DomainModel\UserNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    /** @var EntityManager */
    private $em;
    /** @var UserRepositoryInterface */
    private $repository;

    public function __construct(EntityManager $em, $entityClass)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($entityClass);
    }

    public function save(UserEntity $bookEntity)
    {
        $this->em->persist($bookEntity);
        $this->em->flush();
    }

    public function getById(string $id) : UserEntity
    {
        $bookEntity = $this->repository->find($id);
        if (!$bookEntity instanceof UserEntity) {
            throw new UserNotFoundException('User Not Found');
        }
        return $bookEntity;
    }

    public function doesUserExist(string $email) : bool
    {
        $userEntity =  $this->repository->findOneBy(['emailCanonical' => strtolower($email)]);
        return ($userEntity instanceof UserEntity);
    }
}
