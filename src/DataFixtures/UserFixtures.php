<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
//use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $user = new User();
        // $user->
        $manager->flush();
    }
}
