<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuyYourCarController extends AbstractController
{
    /**
     * @Route("/conseils/bien_acheter", name="bien_acheter")
     */
    public function index(): Response
    {
        return $this->render('buy_your_car/index.html.twig', [
            'controller_name' => 'BuyYourCarController',
        ]);
    }
}
