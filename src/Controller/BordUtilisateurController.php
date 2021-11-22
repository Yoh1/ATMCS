<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BordUtilisateurController extends AbstractController
{
    /**
     * @Route("/bord/utilisateur", name="bord_utilisateur")
     */
    public function index(): Response
    {
        return $this->render('bord_utilisateur/index.html.twig', [
            'controller_name' => 'BordUtilisateurController',
        ]);
    }
}
