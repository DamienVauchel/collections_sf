<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRAND_1 = 'brand_1';

    public function load(ObjectManager $manager)
    {
        $brand1 = new Brand();
        $brand1->setName('Agfa')
            ->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tempus egestas turpis, at viverra elit feugiat non. Pellentesque odio diam, pellentesque vel bibendum vitae, ultrices a elit. Maecenas semper nisi sem, at laoreet odio varius vitae. Nam fermentum velit elit, in interdum leo ornare et. Duis maximus, nisl id porttitor eleifend, ligula mauris gravida turpis, et aliquam velit purus at odio. Donec eget sapien mi. Suspendisse et feugiat dolor. Donec tellus elit, vestibulum quis massa et, tristique suscipit sem. Maecenas fermentum, ante sit amet pellentesque euismod, tortor est pulvinar nisl, sed pellentesque felis metus a nunc. In fringilla et nibh sed tristique. Sed augue nibh, rhoncus in imperdiet a, eleifend convallis nulla. Aenean at luctus purus, eu aliquet ante. Phasellus euismod nisi pharetra justo pulvinar feugiat. Donec convallis non nisi vel sodales. Duis scelerisque purus quam.');
        $manager->persist($brand1);
        $this->setReference(self::BRAND_1, $brand1);

        $manager->flush();
    }
}
