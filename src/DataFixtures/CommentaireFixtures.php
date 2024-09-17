<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentaireFixtures extends Fixture
{
    public const COMMENTAIRE_REFERENCE = 'Commentaire';
    
    public const NUM_COMMENTAIRES = 10;

    public function load(ObjectManager $manager): void
    {
        $commentaire = [
            "Absolutely delicious! The perfect balance of flavors.",
            "A bit too spicy for my taste, but still really good!",
            "The cheese melts perfectly with the beef, highly recommend!",
            "Loved the crispy bacon and the smoky BBQ sauce.",
            "Not a fan of the pretzel bun, but the burger itself was great.",
            "This is my go-to burger! So juicy and flavorful.",
            "The caramelized onions really took this burger to the next level.",
            "Great vegetarian option, the veggie patty was well-seasoned.",
            "I wish the bun was a bit softer, but the ingredients were fresh.",
            "Perfect for a cheat day! This burger is huge and satisfying.",
        ];
 
        foreach ($commentaire as $key => $content) {
            $commentaire = new Commentaire();
            $commentaire->setContent($content);
            $manager->persist($commentaire);
            $this->addReference(self::COMMENTAIRE_REFERENCE . '_' . $key, $commentaire);
        }

        $manager->flush();
    }
}
