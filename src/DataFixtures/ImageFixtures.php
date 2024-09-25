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
            "https://www.biofournil.com/wp-content/uploads/2021/02/BRIOCHE-BIOFOURNIL_web.jpg",
            "https://img.freepik.com/photos-gratuite/delicieux-burger-ingredients-frais_23-2150857908.jpg",
            "https://www.lesepicesrient.fr/wp-content/uploads/2022/05/burger-barbecue-miel-01.jpg",
            "https://lacuisineensemble.fr/wp-content/uploads/2022/02/recette-burger-maison.jpg",
            "https://www.shutterstock.com/shutterstock/photos/2494691375/display_1500/stock-photo-close-up-of-tasty-burger-isolated-on-white-background-french-fries-and-the-burger-with-meat-2494691375.jpg",
            "https://images.radio-canada.ca/v1/alimentation/recette/4x3/burger-jamaicaine.jpg",
            "https://static.vecteezy.com/ti/photos-gratuite/p1/19023604-vue-de-face-burger-de-viande-savoureux-avec-fromage-et-salade-gratuit-photo.jpg",
            "https://www.charal.fr/wp-content/uploads/2024/01/Burger-catalan-poivrons-et-chips-de-chorizo-1.webp",
            "https://foodservice.harrys.fr/wp-content/uploads/test.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtwZhjUgBYLXIYLDu0i2m_8ND--9WIvEcEOg&s",
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
