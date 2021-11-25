<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarPurchaseController extends AbstractController
{
    /**
     * @Route("conseils/achat_voiture", name="achat_voiture")
     */
    public function index(): Response
    {
        return $this->render('car_purchase/index.html.twig', [
            'controller_name' => 'CarPurchaseController',
        ]);
    }
}
