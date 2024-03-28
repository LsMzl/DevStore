<?php

namespace App\DataFixtures;

use App\Entity\Images;
use Faker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {

        //Permet de générer des fausses données dans la langues locale spécifiée
        $faker = Faker\Factory::create('fr_FR');

        for ($img = 1; $img <= 100; $img++) {

            $image = new Images();
            $image->setName($faker->image(null, 640, 480));
            $product = $this->getReference('prod-' . rand(1, 15));
            $image->setProducts($product);

            $manager->persist($image);
        }

        $manager->flush();
    }
    /**
     * Permet d'utiliser DependentFixtureInterface 
     * Gère l'ordre dans lequel sont executées les fixtures
     * @return array Tableau contenant les fixtures à executer avant la fixtures Images
     */
    public function getDependencies(): array
    {
        return [
            ProductsFixtures::class
        ];
    }
}
