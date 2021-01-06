<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {   
        // création de 10 articles
        for($i = 1; $i <= 10; $i++){
            $article = new Article();
            // après la création de de la class Article rajouter un use au dessus pour savoir d'ou vient cette classe
            $article->setTitle("Titre de l'article n°$i")
                    ->setContent("<p>Contenu de l'article n°$i</p>")
                    ->setImage("http://placehold.il/350x150")
                    ->setCreatedAt(new \DateTime());
            $manager->persist($article);

        }   

        $manager->flush();
    }
}
