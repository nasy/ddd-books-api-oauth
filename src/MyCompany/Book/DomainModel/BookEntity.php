<?php

namespace MyCompany\Book\DomainModel;

use MyCompany\Identity\DomainModel\EntityID;

class BookEntity
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $author;
    /** @var \DateTime */
    private $createdAt;

    public static function create(
        EntityID $id,
        string $title = null,
        string $author = null
    ) {
        $self = new self();
        $self->id = $id->id();
        $self->title = $title;
        $self->author = $author;
        $self->createdAt = new \Datetime("now");
        return $self;
    }

    public function update(
        string $title = null,
        string $author = null
    ) {
        if(!is_null($title)) {
            $this->title = $title;
        }
        if(!is_null($author)) {
            $this->author = $author;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function id() : string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function author() : string
    {
        return $this->author;
    }

    /**
     * @return \DateTime
     */
    public function createdAt() : \DateTime
    {
        return $this->createdAt;
    }
}