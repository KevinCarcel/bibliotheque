<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\Editeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        //Data Auteur
        $auteur = [];
        for ($i = 0; $i < 10; $i++) {
        $auteur=new Auteur();
        $auteur->setName($this->faker->name());

         //ajout de l'auteur dans le tableau
         $auteurs[] = $auteur;

        $manager->persist($auteur);
    }
        //Data Editeur
        $editeur = [];
        for ($j = 0; $j < 10; $j++) {
            $editeur=new Editeur();
            $editeur->setName($this->faker->name());

        //ajout de l'auteur dans le tableau
         $editeurs[] = $editeur;

            $manager->persist($editeur);
    }
          //Data livre

          for ($k = 0; $k < 10; $k++) {
            $livre=new Livre();
            $livre->setName($this->faker->name());
            
          $manager->persist($livre);
    }
        $manager->flush();

    }
}