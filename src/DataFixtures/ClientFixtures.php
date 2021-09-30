<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Client;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $clients = Array();
        $users = $manager->getRepository(User::class)->findAll();
        $countUser = count($users);
        dd($countUser);
        
        

        while($countUser > 0){
            $clients = new Client();
            $clients->getUserId()->getUserIdentifier();
            $clients->setWeight($faker->randomDigit);
            $clients->setName($clients->getUserId()->getName());


            $manager->persist($clients);

        }

        $manager->flush();
    }
}
