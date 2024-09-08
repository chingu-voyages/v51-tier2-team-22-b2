<?php

namespace App\DataFixtures;

use App\Entity\Expense;
use App\Entity\ExpenseCategory;
use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Random\RandomException;

class ExpenseFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws RandomException
     */
    public function load(ObjectManager $manager): void
    {
        $expenseCategories = $manager->getRepository(ExpenseCategory::class)->findAll();
        $groups = $manager->getRepository(Group::class)->findAll();
        foreach ($groups as $group) {
            $usersGroup = $group->getUsers();
            foreach ($expenseCategories as $expenseCategory) {
                $expense = new Expense();
                $expense
                    ->setName('Expense ' . $expenseCategory->getName())
                    ->setDescription('Description for ' . strtolower($expenseCategory->getName()))
                    ->setAmount(random_int(5, 10))
                    ->setContributionPercent(0)
                    ->setDate(new \DateTime())
                    ->setUser($usersGroup->get(random_int(0, $usersGroup->count() - 1)))
                    ->setGroup($group)
                ;
                $manager->persist($expense);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GroupFixtures::class,
            ExpenseCategoryFixtures::class
        ];
    }
}
