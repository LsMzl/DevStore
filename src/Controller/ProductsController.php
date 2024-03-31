<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


//Route "générale" vers la page des produits
#[Route('/produits', name: 'products_')]

class ProductsController extends AbstractController
{
  //Route vers la page des produits
  #[Route('/', name: 'index')]
  public function index(ProductsRepository $repository): Response
  {
    $products = $repository->findAll();

    return $this->render(
      'products/index.html.twig',
      [
        'products' => $products
      ]
    );
  }

  //Route vers la page d'un produit selon son slug
  #[Route('/{slug}', name: 'details')]
  public function details(Products $product): Response
  {

    // dd($product);
    return $this->render(
      'products/details.html.twig',
      [
        'product' => $product
      ]
    );
  }
}
