<?php

namespace App\DataFixtures;

use App\Entity\Pain;
use App\Entity\Product;
use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OignonFixtures extends Fixture
{
    public const OIGNON_REFERENCE = 'Oignon';

    public function load(ObjectManager $manager): void
    {
        $nomsPains = [
            "Caramelized Onions",
            "Crispy Fried Onions",
            "Red Onion Rings",
            "Grilled Sweet Onions",
            "Pickled Onions",
        ];
 
        foreach ($nomsPains as $key => $nomPain) {
            $pain = new Sauce();
            $pain->setName($nomPain);
            $manager->persist($pain);
            $this->addReference(self::OIGNON_REFERENCE . '_' . $key, $pain);
        }

        $manager->flush();
    }
}
