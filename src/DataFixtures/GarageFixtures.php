<?php

namespace App\DataFixtures;

use App\Entity\Garage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GarageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $garage = new Garage();
        $garage
            ->setName('Garage V.Parrot')
            ->setSlug(slug: 'vparrot')
            ->setAddress('rue de la déchèterie')
            ->setZipCode('75100')
            ->setCity('Paris')
            ->setPhone('0669000000');
        $manager->persist($garage);
        $manager->flush();
    }
}
