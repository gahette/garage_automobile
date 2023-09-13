<?php

namespace App\DataFixtures;

use App\Entity\Services;
use App\Repository\GarageRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ServicesFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public function __construct(protected GarageRepository $garageRepository)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        $garages = $this->garageRepository->findAll();
        foreach ($garages as $garage) {
            for ($i = 0; $i < 7; ++$i) {
                $services = new Services();
                $services
                    ->setGarage(garage: $garage)
                    ->setCategory(category: $this->faker->word())
                    ->setName(name: $this->faker->name())
                    ->setContent(content: $this->faker->Text(10))
                    ->setIsApproved(is_approved: $this->faker->boolean(70))
                    ->setPrice(price: $this->faker->randomNumber(3, false));
                $manager->persist($services);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GarageFixtures::class,
        ];
    }
}
