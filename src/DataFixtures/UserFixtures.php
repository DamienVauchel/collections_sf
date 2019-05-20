<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER_1 = 'user_1';

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('super')
            ->setUsernameCanonical('super')
            ->setEmail('super@admin.fr')
            ->setEmailCanonical('super@admin.fr')
            ->setEnabled(true)
            ->setSuperAdmin(true)
            ->setPlainPassword('admin')
            ->setFirstname('Damien')
            ->setLastname('Vauchel')
            ->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($user1);
        $this->setReference(self::USER_1, $user1);

        $manager->flush();
    }
}
