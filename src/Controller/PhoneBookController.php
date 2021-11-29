<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\CarRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhoneBookController extends AbstractController
{
    /**
     * @Route("/phonebook", name="phone_book")
     */
    public function index(CarRepository $carRepository, BookingRepository $booking, UsersRepository $sellersRepo): Response
    {
        $annoncesPro = $carRepository->findAll();

        //Liste des voitures réservées
        $bookedCars = $booking->findAll();

        //List des vendeurs
        $sellers = $sellersRepo->findAll();

        return $this->render('phone_book/index.html.twig', [
            'controller_name' => 'PhoneBookController',
            'annonces' => $annoncesPro,
            'bookedCars' => $bookedCars,
            'sellers' => $sellers
        ]);
    }
}
