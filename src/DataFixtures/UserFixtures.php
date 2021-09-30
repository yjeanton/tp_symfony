<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $user = new User;
        $user->setEmail('alan@alan.fr');
        $user->setRoles(['ROLE_VISITOR']);
        $user->setName($faker->name);

        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            '123'
        ));

        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
