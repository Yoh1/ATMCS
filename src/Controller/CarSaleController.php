<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarSaleController extends AbstractController
{
    /**
     * @Route("/conseils/ventes_voiture", name="vente_voiture")
     */
    public function index(): Response
    {
        return $this->render('car_sale/index.html.twig', [
            'controller_name' => 'CarSaleController',
        ]);
    }
}
