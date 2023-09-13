<?php

namespace App\DataFixtures;

use App\Entity\Messages;
use App\Repository\CarsRepository;
use App\Repository\UsersRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MessagesFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function __construct(protected UsersRepository $usersRepository, protected CarsRepository $carsRepository)
    {
        parent::__construct();
    }

    public function getDependencies(): array
    {
        return [
            UsersFixtures::class,
            CarsFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $users = $this->usersRepository->findAll();
        $cars = $this->carsRepository->findAll();
        foreach ($cars as $car) {
            foreach ($users as $user) {
                for ($i = 0; $i < $this->faker->numberBetween(1, 3); ++$i) {
                    $messages = new Messages();
                    $messages
                        ->setUsers(users: $user)
                        ->setCars(cars: $car)
                        ->setLastname(lastname: $this->faker->lastName())
                        ->setFirstname(firstname: $this->faker->firstName())
                        ->setEmail(email: $this->faker->email())
                        ->setPhone(phone: $this->faker->phoneNumber())
                        ->setContent(content: $this->faker->Text(10))
                        ->setUpdatedAt(updatedAt: $this->faker->dateTime());
                    $manager->persist($messages);
                }
            }
        }
        $manager->flush();
    }
}
