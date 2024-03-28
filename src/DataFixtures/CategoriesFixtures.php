<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    private $counter =1;

    /**
     * 
     * @param SluggerInterface $slugger Permet de créer des slugs.
     */
    public function __construct(private SluggerInterface $slugger)
    {
    }

    /**
     * 
     * @param ObjectManager $manager Permet d'accéder aux fonctions persist() et flush().
     */
    public function load(ObjectManager $manager): void
    {
        //Création d'une catégorie informatique .
        $informatique = $this->createCategory('informatique', 'Informatique', null, $manager);

        //Création d'une catégorie ordinateur qui sera un enfant de la catégorie informatique.
        $this->createCategory('ordinateur', 'Ordinateurs', $informatique, $manager);

        //Création d'une catégorie ecran qui sera un enfant de la catégorie informatique.
        $this->createCategory('ecrans', 'Ecrans d\'ordinateur', $informatique, $manager);

        //Création d'une catégorie ecran qui sera un enfant de la catégorie informatique.
        $this->createCategory('souris', 'Souris d\'ordinateur', $informatique, $manager);


        //Création d'une catégorie téléphonie.
        $telephonie = $this->createCategory('téléphonie', 'Téléphonie', null, $manager);

        //Création d'une catégorie téléphoneP qui sera un enfant de la catégorie telephonie.
        $this->createCategory('telephoneP', 'Téléphones Portables', $telephonie, $manager);

        //Création d'une catégorie accessoires qui sera un enfant de la catégorie telephonie.
        $this->createCategory('accessoires', 'Accessoires', $telephonie, $manager);

        $manager->flush();
    }

    /**
     * Permet la création de catégories fictives
     * @param string $CategoryName Nom de la catégorie à créer
     * @param $CategoryName
     * @param Categories $parent Sert à définir une catégorie parent si besoin
     * @param ObjectManager $manager Permet d'accéder aux fonctions persist() et flush().
     */
    public function createCategory(string $Category, $CategoryName, Categories $parent = null, ObjectManager $manager)
    {
        //Création d'un objet catégorie.
        $Category = new Categories();

        //Construction de l'objet selon ses propriétés.
        $Category->setName($CategoryName)
            //Création d'un slug en utilisant SluggerInterface.
            ->setSlug($this->slugger->slug($Category->getName())->lower())
            //Définition d'un parent si besoin
            ->setParent($parent);
        //Persistance des données. 
        $manager->persist($Category);

        $this->addReference('cat-'.$this->counter, $Category);
        $this->counter++;

        //Permet de récupérer la catégorie si c'est un parent
        return $Category;
    }
}
