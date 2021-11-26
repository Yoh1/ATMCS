<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    /**
     * @Route("/message/{idSender}/{idReceiver}", name="message")
     */
    public function index(Request $request, EntityManagerInterface $manager, $idSender, $idReceiver): Response
    {
        $message = new Message();

        $form = $this->createFormBuilder($message)
                    ->add('content', TextareaType::class)
                    ->getForm();

        
        $form->handleRequest($request);

        $repoUser = $this->getDoctrine()->getRepository(Users::class);

        $sender = $repoUser->find($idSender);
        $receiver = $repoUser->find($idReceiver);


        if ($form->isSubmitted() && $form->isValid()) {

            
            $message->setIdSender($sender);
            $message->setIdReceiver($receiver);
            $message->setSentAt(new \DateTimeImmutable());

            $manager->persist($message);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
            'formMessage' => $form->createView(),
            'receiver' => $receiver
        ]);
    }
}
