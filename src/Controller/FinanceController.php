<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FinanceController extends AbstractController
{
    /**
     * @Route("/finance", name="finance")
     */
    public function index(): Response
    {
        return $this->render('finance/index.html.twig', [
            'controller_name' => 'FinanceController',
        ]);
    }
}
