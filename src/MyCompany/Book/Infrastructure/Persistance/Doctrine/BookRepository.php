<?php

namespace MyCompany\Book\Infrastructure\Persistance\Doctrine;

use MyCompany\Book\DomainModel\BookRepository as BookRepositoryInterface;
use MyCompany\Book\DomainModel\BookEntity;
use Doctrine\ORM\EntityManager;
use MyCompany\Book\DomainModel\BookNotFoundException;

class BookRepository implements BookRepositoryInterface
{
    /** @var EntityManager */
    private $em;
    /** @var BookRepositoryInterface */
    private $repository;

    public function __construct(EntityManager $em, $entityClass)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($entityClass);
    }

    public function save(BookEntity $bookEntity)
    {
        $this->em->persist($bookEntity);
        $this->em->flush();
    }

    public function delete(BookEntity $bookEntity)
    {
        $this->em->remove($bookEntity);
        $this->em->flush();
    }

    public function getById(string $id)
    {
        $bookEntity = $this->repository->find($id);
        if (!$bookEntity instanceof BookEntity) {
            throw new BookNotFoundException('Book Not Found');
        }
        return $bookEntity;
    }

    public function getAll(int $limit = 25, int $offset = 0)
    {
        return $this->repository->findAll();
    }
}
