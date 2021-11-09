<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellController extends AbstractController
{
    /**
     * @Route("/sell", name="sell")
     */
    public function index(): Response
    {
        return $this->render('sell/index.html.twig', [
            'controller_name' => 'SellController',
        ]);
    }
}
