<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassicCreditController extends AbstractController
{
    /**
     * @Route("/finance/credit_classique", name="credit_classique")
     */
    public function index(): Response
    {
        return $this->render('classic_credit/index.html.twig', [
            'controller_name' => 'ClassicCreditController',
        ]);
    }
}
