<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BurgerFixtures extends Fixture implements DependentFixtureInterface
{
    public const BURGER_REFERENCE = 'Burger';

    public function load(ObjectManager $manager): void
    {
        $nomsBurgers = [
            "Cheddar Supreme",
            "BBQ Bacon Delight",
            "Spicy Jalapeño Crunch",
            "Mushroom Swiss Melt",
            "Classic Double Cheeseburger",
            "Crispy Chicken Stack",
            "Veggie Garden Burger",
            "Smokey Chipotle Burger",
            "Truffle Burger",
            "Mediterranean Feta Burger"
        ];
        
        foreach ($nomsBurgers as $key => $nomBurger) {
            $burger = new Burger();
            $burger->setName($nomBurger);
            $burger->setPrice(rand(5, 15));
            $burger->setPain($this->getReference(PainFixtures::PAIN_REFERENCE . '_' . rand(0, PainFixtures::NUM_PAINS - 1)));
            $burger->setOignon($this->getReference(OignonFixtures::OIGNON_REFERENCE . '_' . rand(0, OignonFixtures::NUM_OIGNONS - 1)));
            for ($i = 0; $i < rand(1, 3); $i++) {
                $burger->addSauce($this->getReference(SauceFixtures::SAUCE_REFERENCE . '_' . rand(0, SauceFixtures::NUM_SAUCES - 1)));
            }
            for ($i = 0; $i < rand(1, 3); $i++) {
                $burger->addCommentaire($this->getReference(CommentaireFixtures::COMMENTAIRE_REFERENCE . '_' . rand(0, CommentaireFixtures::NUM_COMMENTAIRES - 1)));
            }
            $burger->setImage($this->getReference(ImageFixtures::IMAGE_REFERENCE . '_' . $key));
            $manager->persist($burger);
            $this->addReference(self::BURGER_REFERENCE . '_' . $key, $burger);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PainFixtures::class,
            SauceFixtures::class,
            OignonFixtures::class
        ];
    }
}
