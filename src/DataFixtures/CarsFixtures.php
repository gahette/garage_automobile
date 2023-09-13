<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use App\Repository\GarageRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CarsFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function __construct(protected GarageRepository $garageRepository)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        $garages = $this->garageRepository->findAll();
        foreach ($garages as $garage) {
            for ($i = 0; $i <= 30; ++$i) {
                $cars = new Cars();
                $cars
                    ->setGarage(garage: $garage)
                    ->setBrand(brand: $this->faker->word())
                    ->setModel(model: $this->faker->word())
                    ->setKilometer(kilometer: $this->faker->randomNumber(6, false))
                    ->setYear(year: $this->faker->year())
                    ->setContent(content: $this->faker->realText(10))
                    ->setPrice(price: $this->faker->randomNumber(5, false))
                    ->setUpdatedAt(updatedAt: $this->faker->dateTime());
                $manager->persist($cars);
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
