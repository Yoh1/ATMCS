<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Repository\CarRepository;
use App\Repository\MessageRepository;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\User;

class UserTabController extends AbstractController
{
    /**
     * @Route("/usertab/{id}", name="user_tab")
     */
    public function index($id): Response
    {
        return $this->render('user_tab/index.html.twig', [
            'controller_name' => 'UserTabController',
        ]);
    }

    /**
     * @Route("/usertab/{id}/annonces", name="user_annonce")
     */
    public function showAnnonces($id): Response {
        
        $repoCar = $this->getDoctrine()->getRepository(Car::class);
        $annonces = $repoCar->findBy(['owner' => $id]); 


        return $this->render('user_tab/_annonces.html.twig', [
            'controller_name' => 'UserTabController',
            'annonces' => $annonces
        ]);
    }

    /**
     * @Route("/usertab/{id}/bookings", name="user_bookings")
     */
    public function showBookings($id, CarRepository $repository, BookingRepository $repoBook, UsersRepository $sellersRepo): Response {
        
        $bookings = $repository->findBookingsByUserId($id);

        $bookingList = $repoBook->findBy(['idUser' => $id]);

        //List des vendeurs
        $sellers = $sellersRepo->findAll();

        return $this->render('user_tab/_bookings.html.twig', [
            'controller_name' => 'UserTabController',
            'bookings' => $bookings,
            'bookingList' => $bookingList,
            'sellers' => $sellers
        ]);
    }

    /**
     * @Route("/usertab/{id}/messages", name="user_messages")
     */
    public function showMessages($id, MessageRepository $repoMessage, UsersRepository $repoUsers): Response {

        $messageSent = $repoMessage->findBy(['idSender' => $id]);

        $messageReceived = $repoMessage->findBy(['idReceiver' => $id]);

        $usersList = $repoUsers->findAll();


        return $this->render('user_tab/_messages.html.twig', [
            'controller_name' => 'UserTabController',
            'messageSent' => $messageSent,
            'messageReceived' => $messageReceived,
            'users' => $usersList
        ]);
    }
}