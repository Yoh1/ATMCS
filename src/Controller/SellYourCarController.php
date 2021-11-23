<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellYourCarController extends AbstractController
{
    /**
     * @Route("conseils/vendre_sa_voiture", name="vendre_sa_voiture")
     */
    public function index(): Response
    {
        return $this->render('sell_your_car/index.html.twig', [
            'controller_name' => 'SellYourCarController',
        ]);
    }
}
