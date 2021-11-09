<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdviceController extends AbstractController
{
    /**
     * @Route("/advice", name="advice")
     */
    public function index(): Response
    {
        return $this->render('advice/index.html.twig', [
            'controller_name' => 'AdviceController',
        ]);
    }
}
