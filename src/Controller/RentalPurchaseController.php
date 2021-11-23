<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentalPurchaseController extends AbstractController
{
    /**
     * @Route("/finance/location", name="location_achat")
     */
    public function index(): Response
    {
        return $this->render('rental_purchase/index.html.twig', [
            'controller_name' => 'RentalPurchaseController',
        ]);
    }
}
