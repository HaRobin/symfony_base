<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    public const IMAGE_REFERENCE = 'Image';
    
    public const NUM_IMAGES = 4;

    public function load(ObjectManager $manager): void
    {
        $nomsImages = [
            "burger_1.jpg",
            "burger_10.jpg",
            "burger_2.png",
            "burger_3.jpg",
            "burger_4.jpg",
            "burger_5.jpg",
            "burger_6.png",
            "burger_7.jpg",
            "burger_8.jpg",
            "burger_9.jpg",
        ];
 
        foreach ($nomsImages as $key => $nomImage) {
            $image = new Image();
            $image->setName($nomImage);
            $manager->persist($image);
            $this->addReference(self::IMAGE_REFERENCE . '_' . $key, $image);
        }

        $manager->flush();
    }
}
