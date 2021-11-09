<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogInController extends AbstractController
{
    /**
     * @Route("/log/in", name="log_in")
     */
    public function index(): Response
    {
        return $this->render('log_in/index.html.twig', [
            'controller_name' => 'LogInController',
        ]);
    }
}
