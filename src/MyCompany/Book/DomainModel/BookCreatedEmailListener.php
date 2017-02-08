<?php

namespace MyCompany\Book\DomainModel;

class BookCreatedEmailListener
{
    /**
     * @var BookCreatedEmailInterface
     */
    private $bookCreatedEmail;

    public function __construct(BookCreatedEmailInterface $bookCreatedEmail)
    {
        $this->bookCreatedEmail = $bookCreatedEmail;
    }

    public function notify(BookCreatedEmailEvent $bookCreatedEmailEvent)
    {
        $bookEntity = $bookCreatedEmailEvent->bookEntity();
        $this->bookCreatedEmail->send($bookEntity);
    }
}
