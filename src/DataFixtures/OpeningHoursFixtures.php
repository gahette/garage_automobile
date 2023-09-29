<?php

namespace App\DataFixtures;

use App\Entity\OpeningHours;
use App\Repository\GarageRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OpeningHoursFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function __construct(protected GarageRepository $garageRepository)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        $garages = $this->garageRepository->findAll();
        foreach ($garages as $garage) {
            $openinghours1 = new OpeningHours();
            $openinghours2 = new OpeningHours();
            $openinghours3 = new OpeningHours();
            $openinghours4 = new OpeningHours();
            $openinghours5 = new OpeningHours();
            $openinghours6 = new OpeningHours();
            $openinghours7 = new OpeningHours();

            $openinghours1
                ->setGarage(garage: $garage)
                ->setDay('lun.')
                ->setAmOpenHours('08:45')
                ->setAmCloseHours('12:00')
                ->setPmOpenHours('14:00')
                ->setPmCloseHours('18:00');
            $openinghours2
                ->setGarage(garage: $garages[0])
                ->setDay('mar.')
                ->setAmOpenHours('08:45')
                ->setAmCloseHours('12:00')
                ->setPmOpenHours('14:00')
                ->setPmCloseHours('18:00');
            $openinghours3
                ->setGarage(garage: $garages[0])
                ->setDay('mer.')
                ->setAmOpenHours('08:45')
                ->setAmCloseHours('12:00')
                ->setPmOpenHours('14:00')
                ->setPmCloseHours('18:00');
            $openinghours4
                ->setGarage(garage: $garages[0])
                ->setDay('jeu.')
                ->setAmOpenHours('08:45')
                ->setAmCloseHours('12:00')
                ->setPmOpenHours('14:00')
                ->setPmCloseHours('18:00');
            $openinghours5
                ->setGarage(garage: $garages[0])
                ->setDay('ven.')
                ->setAmOpenHours('08:45')
                ->setAmCloseHours('12:00')
                ->setPmOpenHours('14:00')
                ->setPmCloseHours('18:00');
            $openinghours6
                ->setGarage(garage: $garages[0])
                ->setDay('sam.')
                ->setAmOpenHours('08:45')
                ->setAmCloseHours('12:00');
            $openinghours7
                ->setGarage(garage: $garages[0])
                ->setDay('dim.')
                ->setAmOpenHours('Fermé');
            $manager->persist($openinghours1);
            $manager->persist($openinghours2);
            $manager->persist($openinghours3);
            $manager->persist($openinghours4);
            $manager->persist($openinghours5);
            $manager->persist($openinghours6);
            $manager->persist($openinghours7);
            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            GarageFixtures::class,
        ];
    }
}
