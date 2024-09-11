<?php

namespace App\DataFixtures;

use App\Entity\Pain;
use App\Entity\Product;
use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SauceFixtures extends Fixture
{
    public const SAUCE_REFERENCE = 'Sauce';

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $nomsSauces = [
            'Blanche',
            'Mayonnaise',
            'Ketchup',
            'Barbecue',
            'Biggy',
            'Andalouse'
        ];
 
        foreach ($nomsSauces as $key => $nomSauce) {
            $sauce = new Sauce();
            $sauce->setName($nomSauce);
            $manager->persist($sauce);
            $this->addReference(self::SAUCE_REFERENCE . '_' . $key, $sauce);
        }

        $manager->flush();
    }
}
