<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    // réécriture de la fonction delete
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void{

        if($entityInstance->getBooked()) {
        
            //récupération de la réservation associé à la voiture sur le point d'être supprimée
            $booking = $entityManager->getRepository(Booking::class)->findOneBy(['idCar'=>$entityInstance->getId()]);
        
            $entityManager->remove($booking);
            $entityManager->flush();
        
        }

        $entityManager->remove($entityInstance);
        $entityManager->flush();
        
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
