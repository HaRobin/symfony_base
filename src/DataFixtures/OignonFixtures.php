<?php

namespace App\DataFixtures;

use App\Entity\Oignon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OignonFixtures extends Fixture
{
    public const OIGNON_REFERENCE = 'Oignon';
    
    public const NUM_OIGNONS = 5;

    public function load(ObjectManager $manager): void
    {
        $nomsOignons = [
            "Caramelized Onions",
            "Crispy Fried Onions",
            "Red Onion Rings",
            "Grilled Sweet Onions",
            "Pickled Onions",
        ];
 
        foreach ($nomsOignons as $key => $nomOignon) {
            $oignon = new Oignon();
            $oignon->setName($nomOignon);
            $manager->persist($oignon);
            $this->addReference(self::OIGNON_REFERENCE . '_' . $key, $oignon);
        }

        $manager->flush();
    }
}
