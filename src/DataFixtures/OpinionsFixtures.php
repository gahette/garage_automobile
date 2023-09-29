<?php

namespace App\DataFixtures;

use App\Entity\Opinions;
use App\Repository\UsersRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OpinionsFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function __construct(protected UsersRepository $usersRepository)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        $users = $this->usersRepository->findAll();

        foreach ($users as $user) {
            $opinions = new Opinions();
            $opinions
                ->setUsers($user)
                ->setMark(mark: $this->faker->numberBetween(0, 5))
                ->setName(name: $this->faker->name)
                ->setSlug(slug: $this->faker->slug)
                ->setContent(content: $this->faker->realText(10))
                ->setIsApproved(is_approved: $this->faker->boolean(65))
                ->setUpdatedAt(updatedAt: $this->faker->dateTime());
            $manager->persist($opinions);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UsersFixtures::class,
        ];
    }
}
