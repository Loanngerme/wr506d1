<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SlugifyService;


class ProductController extends AbstractController
{
    #[Route('/products', name: 'listProducts')]
    public function listProducts(SlugifyService $slugifyService): Response
    {
        $slug = $slugifyService->generate("Jean d'été");
        return $this->render('product/index.html.twig', [
            'title' => 'Liste des produits',
            'slug' => $slug,
        ]);
    }

    #[Route('/product/{id}', name: 'viewProduct')]
    public function viewProduct(int $id): Response
    {

        return $this->render('product/view.html.twig', [
            'product' => $id,
        ]);
    }
}