<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Users;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", name="booking")
     */
    public function index(): Response
    {
        return $this->render('booking/index.html.twig', [
            'controller_name' => 'BookingController',
        ]);
    }


    /**
     * Réserver une voiture
     *
     * @Route("{idCar}+{idUser}", name="booked")
     */
    public function bookingCar(EntityManagerInterface $manager, $idCar, $idUser) {

        $repoCar = $this->getDoctrine()->getRepository(Car::class);
        $bookedCar = $repoCar->find($idCar);
        
        $repoUser = $this->getDoctrine()->getRepository(Users::class);
        $bookingUser = $repoUser->find($idUser);

        $booking = new Booking();

        $booking->setIdUser($bookingUser)
                ->setIdCar($bookedCar)
                ->setBookedAt(new \DateTimeImmutable());

        $manager->persist($booking);
        $manager->flush();

        return $this->redirectToRoute('research');
    }
}
