<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{

    //Route vers la page d'accueil
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('main/home.html.twig', [
            'controler_name' => 'MainController',
        ]);
    }
}
