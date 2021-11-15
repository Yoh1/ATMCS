<?php

namespace App\Controller;

use App\Entity\Annonce;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

// use Symfony\Component\HttpFoundation\Response;

//use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AddController extends AbstractController
{


    /**
     * @Route("/add", name="add")
     */


    public function index(Request $request, EntityManagerInterface $manager)
    {


        $annonce = new Annonce();

        $form = $this->createFormBuilder($annonce)
            ->add('marque')
            ->add('modele')
            ->add('annee')
            ->add('kilometrage')
            ->add('prix')
            ->add('localisation')
            ->add('date')
            ->add('image')
            ->getForm();



        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setdate(new \DateTime());

            $manager->persist($annonce);
            $manager->flush();

            return $this->redirectToRoute('show_annonce', ['id' => $annonce->getId()]);
        }
        return $this->render('add/index.html.twig', [
            'controller_name' => 'AddController',
            'formAnnonce' => $form->createView()
        ]);
    }


    /**
     * @Route("/annonce", name="show_annonce")
     */


    public function showAnnonce()
    {

        $repo = $this->getDoctrine()->getRepository(Annonce::class);

        $annonces = $repo->find('id');

        //dd($annonces);

        return $this->render('add/annonce.html.twig', [
            'controller_name' => 'AddController',
            'annonces' => $annonces

        ]);
    }
}
