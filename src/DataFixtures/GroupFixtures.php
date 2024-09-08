<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $users = $manager->getRepository(User::class)->findAll();
        $group = new Group();
        $group->setName('Group 1');
        $group->addUser($users[0]);
        $group->addUser($users[1]);
        $group->addUser($users[2]);
        $group->addUser($users[3]);
        $manager->persist($group);
        $group = new Group();
        $group->setName('Group 2');
        $group->addUser($users[4]);
        $group->addUser($users[5]);
        $group->addUser($users[6]);
        $manager->persist($group);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
