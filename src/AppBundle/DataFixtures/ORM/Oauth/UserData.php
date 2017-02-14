<?php

namespace AppBundle\DataFixtures\ORM\Oauth;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use MyCompany\Identity\Infrastructure\UUID;

use MyCompany\Oauth\DomainModel\UserEntity;

class UserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    static public $users = [];

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $factory = $this->container->get('security.encoder_factory');
        $userOne = UserEntity::create(
            $factory,
            UUID::create(),
            'test@test.com',
            '1234'
        );
        $manager->persist($userOne);

        $manager->flush();
        self::$users[] = $userOne;
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}