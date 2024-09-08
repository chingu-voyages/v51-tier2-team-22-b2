<?php

namespace App\DataFixtures;

use App\Entity\ExpenseCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpenseCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ([
            'Birthday',
            'Dinner',
            'Concert',
            'Car',
            'Pet',
            'House',
            'Internet',
            'Clothes'
        ] as $name) {
            $expenseCategory = new ExpenseCategory();
            $expenseCategory->setName($name);
            $manager->persist($expenseCategory);
        }

        $manager->flush();
    }
}
