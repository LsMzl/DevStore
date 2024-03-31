<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


//Route "générale" vers la page de profil utilisateur
#[Route('/profil', name: 'profile_')]

class UsersController extends AbstractController
{
    //Route vers la page de profil utilisateur
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render(
            'users/profile.html.twig',
            [
                'controller_name' => 'ProfileController',
            ]
        );
    }

    //Route vers la page informations d'un utilisateur selon son id
    #[Route('/{id}', name: 'details')]
    public function details(Users $user): Response
    {
        return $this->render(
            'users/details.html.twig',
            [
                'user' => $user
            ]
        );
    }

    //Route vers la page des commandes utilisateur
    #[Route('/{id}/commandes', name: 'orders')]
    public function orders(Users $user, Orders $orders): Response
    {
        return $this->render(
            'users/orders.html.twig',
            [
                'user' => $user,
                'orders' => $orders
            ]
        );
    }

    //Route vers la page adresses d'un utilisateur selon son id
    #[Route('/{id}/addresses', name: 'addresses')]
    public function address(Users $user): Response
    {
        return $this->render(
            'users/address.html.twig',
            [
                'user' => $user
            ]
        );
    }

    //Route vers la page panier d'un utilisateur selon son id
    #[Route('/{id}/panier', name: 'cart')]
    public function cart(Users $users, Orders $orders): Response
    {
        return $this->render(
            'users/carts.html.twig',
            [
                'user' => $users,
                'orders' => $orders
            ]
        );
    }







}
