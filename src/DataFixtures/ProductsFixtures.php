<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Faker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductsFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {

        //Permet de générer des fausses données dans la langues locale spécifiée
        $faker = Faker\Factory::create('fr_FR');

        for ($prod = 1; $prod <= 15; $prod++) {
            $product = new Products();

            $product->setName($faker->text(5))
                ->setDescription($faker->text())
                ->setSlug($this->slugger->slug($product->getName())->lower())
                ->setPrice($faker->numberBetween(2000, 300000))
                ->setStock($faker->numberBetween(0, 30));

            $category = $this->getReference('cat-' . rand(1, 7));                      //Récupération d'une référence de catégorie aléatoire

            $product->setCategories($category);
            $this->setReference('prod-' . $prod, $product);
            
            $manager->persist($product);
        }

        $manager->flush();
    }
}
