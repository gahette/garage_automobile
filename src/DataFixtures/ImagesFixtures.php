<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Repository\CarsRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class ImagesFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function __construct(protected CarsRepository $carsRepository)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        $cars = $this->carsRepository->findAll();

        foreach ($cars as $car) {
            for ($i = 1; $i < $this->faker->numberBetween(1, 4); ++$i) {
                $images = new Images();
                $file = new File(path: $this->faker->image('public/images/'));
                $images->setCar($car);
                $images->setFile($file)
                    ->setUpdatedAt($this->faker->dateTime());

                $manager->persist($images);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CarsFixtures::class,
        ];
    }
}
