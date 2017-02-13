<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClientCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:create-client');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $clientManager =  $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setName('User Access');
        $client->setRedirectUris(array('http://www.example.com'));
        $client->setAllowedGrantTypes(array('refresh_token', 'password'));
     //   $client->setAllowedGrantTypes(array('token', 'refresh_token', 'client_credentials', 'authorization_code', 'password'));
        $client->setSecret($client->getSecret());
        $client->setRandomId($client->getRandomId());

        $clientManager->updateClient($client);

        $output->write('Client created');
        $output->writeln(sprintf("<info>The client <comment>%s</comment> was created with <comment>%s</comment> as public id and <comment>%s</comment> as secret</info>",
            $client->getName(),
            $client->getPublicId(),
            $client->getSecret()));

         // With the output generated, make a call to: (use public id as client id)
         // http://localhost:8888/ddd-books-api-oauth/web/app_dev.php/oauth/v2/token?client_id=f72dc734-ef84-11e6-b084-190cf29b3123_4k771zv4uysk8880woo8wcwkks4ks84s0kowccgkcg8owkg80o&client_secret=sgixuiajl4go84ckww8800o8gog040gkc00sws0c4cswwskkk&grant_type=password&username=test@gmail.com&password=1234
    }
}