<?php

namespace App\Controller;

use App\Entity\Car;
//use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

// use Symfony\Component\HttpFoundation\Response;

//use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddController extends AbstractController
{


    /**
     * @Route("/add", name="add")
     */
    public function index(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger)
    {

        $annonce = new Car();

        $form = $this->createFormBuilder($annonce)
            ->add('brand')
            ->add('model')
            ->add('year')
            ->add('mileage', NumberType::class)
            ->add('price', MoneyType::class)
            ->add('location')
            ->add('dateFirst', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('engine')
            ->add('picture', FileType::class, [
                'label' => 'Photo de la voiture',
                'mapped' => true,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Merci d\'ajouter un fichier JPEG ou PNG',
                    ])
                ]
            ])
            //->add('description')
            ->getForm();


        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            //$annonce->setdate(new \DateTime());

            /**
             * @var UploadedFile $pictureFile
             */
            $pictureFile = $form->get('picture')->getData();

            if($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename. '-' .uniqid(). '.' .$pictureFile->guessExtension();

                try {
                    $pictureFile->move(
                        $this->getParameter('cars_pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // exception
                }

                $annonce->setPicture($newFilename);

            }

            $manager->persist($annonce);
            $manager->flush();

            return $this->redirectToRoute('show_annonce', ['id' => $annonce->getId()]);
        }

        return $this->render('add/index.html.twig', [
            'controller_name' => 'AddController',
            'formAnnonce' => $form->createView(),
        ]);
    }


    /**
     * @Route("/annonce/{id}", name="show_annonce")
     */
    public function showAnnonce($id)
    {

        $repo = $this->getDoctrine()->getRepository(Car::class);

        $annonces = $repo->find($id);


        return $this->render('add/annonce.html.twig', [
            'controller_name' => 'AddController',
            'annonces' => $annonces

        ]);
    }
}