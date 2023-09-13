<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends AbstractFixtures
{

    public function __construct()
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; ++$i) {
            $user = new Users();
            $user->setEmail($this->faker->email());
            if (1 === $i) {
                $user->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_EMPLOYEES']);
            }
            $user
                ->setLastname($this->faker->lastName())
                ->setFirstname($this->faker->firstName())
                ->setPlainPassword('password');


            $manager->persist($user);
        }
        $manager->flush();
    }
}
