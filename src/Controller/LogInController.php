<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Persistence\ObjectManager;


// use App\Entity\Annonce;
use App\Entity\index;


class LogInController extends AbstractController
{
    /**
     * @Route("/log/in", name="log_in")
     */
    // public function index(): Response
    // {


    //     $annonce = new Annonce(Request $request, ObjectManager $manager);

    //     $form = $this->createFormBuilder($annonce)
    //         ->add('marque')
    //         ->add('modele')
    //         ->add('anne')
    //         ->add('kilometrage')
    //         ->add('prix')
    //         ->add('localisation')
    //         ->add('date')
    //         ->add('image')
    //         ->getForm();

    //     $form->handleRequest($request);


    //     if ($form->isSubmitted && $form->isValid()) {
    //         $annonce->setdate(new \DateTime());

    //         $manager->persist($annonce);
    //         $manager->flush();

    //         return $this->redirectToRoute('blog_show', ['id' => $annonce->getId()]);







    //     }



    //     return $this->render('blog/Annonce.html.twig', [

    //         'formAnnonce' => $form->createView()
    //     ]);











    //     return $this->render('log_in/index.html.twig', [
    //         'controller_name' => 'LogInController',
    //     ]);






    // }
}
