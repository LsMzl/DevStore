<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UsersFixtures extends Fixture
{
    //Ajout de l'outil de hashage de mot de passe et de l'outil de création de slug.
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private SluggerInterface $slugger
    ) {
    }


    public function load(ObjectManager $manager): void
    {
        $admin = new Users();

        $admin->setFirstname('Louis')
            ->setLastname('Mazzella')
            ->setAddress('19 rue ici')
            ->setZipcode('58642')
            ->setCity('Maville')
            ->setEmail('admin@demo.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));

        $manager->persist($admin);


        //Permet de générer des fausses données dans la langues locale spécifiée
        $faker = Faker\Factory::create('fr_FR');

        //Création de 5 users via une boucle for et l'outil faker
        for ($usr = 1; $usr <= 5; $usr++) {
            $user = new Users();

            $user->setFirstname($faker->firstname)
                ->setLastname($faker->lastName)
                ->setAddress($faker->streetAddress)
                ->setZipcode($faker->postcode)
                ->setCity($faker->city)
                ->setEmail($faker->email)
                ->setPassword($this->passwordHasher->hashPassword($user, 'secret'));

            $manager->persist($user);
        }


        $manager->flush();
    }

    /*public function createUser(string $user, $firstname, $lastname, $address, $zipCode, $city, $email, $password, ObjectManager $manager)
    {
        //Création d'un objet user.
        $user = new Users();
        $user->setFirstname($firstname)
            ->setLastname($lastname)
            ->setAddress($address)
            ->setZipcode($zipCode)
            ->setCity($city)
            ->setEmail($email)
            ->setPassword($this->passwordHasher->hashPassword($user, $password))
            ->setRoles();


        

        //Permet de récupérer la catégorie si c'est un parent
        return $user;
    }*/
}
