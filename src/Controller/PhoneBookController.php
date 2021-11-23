<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhoneBookController extends AbstractController
{
    /**
     * @Route("/phonebook", name="phone_book")
     */
    public function index(): Response
    {
        return $this->render('phone_book/index.html.twig', [
            'controller_name' => 'PhoneBookController',
        ]);
    }
}
