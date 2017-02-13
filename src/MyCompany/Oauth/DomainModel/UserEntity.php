<?php

namespace MyCompany\Oauth\DomainModel;

use FOS\UserBundle\Model\User as BaseUser;
use MyCompany\Identity\DomainModel\EntityID;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserEntity extends BaseUser
{
    protected $id;

    static public function create(
        EncoderFactoryInterface $encoderFactory,
        EntityID $id,
        string $email,
        string $password
    ){
        $self = new self();

        $self->enabled = false;
        $self->roles = [];

        $self->id = $id->id();
        $self->username = $email;
        $self->usernameCanonical = strtolower($email);
        $self->email = $email;
        $self->emailCanonical = strtolower($email);
        $self->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);

        $encoder = $encoderFactory->getEncoder($self);
        $encodedPassword = $encoder->encodePassword($password, $self->getSalt());
        $self->setPassword($encodedPassword);

        $self->confirmationToken = md5(uniqid(rand(), true));

        return $self;
    }
}