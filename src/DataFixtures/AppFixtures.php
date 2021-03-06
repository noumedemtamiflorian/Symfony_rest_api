<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $categories = $this->categorie($manager);
        for ($i = 0; $i < 30; $i++) {
            $article = new Article();
            $article->setTitle($faker->realTextBetween(20, 50));
            $article->setDescription($faker->realTextBetween(100, 200));
            $article->setContent($faker->realTextBetween(600, 1000));
            $article->setCategorie($faker->randomElement($categories));
            $article->setImage('');
            $manager->persist($article);
            $manager->flush();
        }
    }
    public function categorie(ObjectManager $manager)
    {
        $faker = Factory::create();
        $categories = [];
        for ($i = 0; $i < 2; $i++) {
            $categorie = new Categorie();
            $categorie->setTitle($faker->realTextBetween(20, 50));
            $categories[] = $categorie;
            $manager->persist($categorie);
            $manager->flush();
        }
        return $categories;
    }
}
