<?php

namespace App\DataFixtures;

use App\Entity\Car;
use DateTimeInterface;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $brand = array("Peugeot", "Renault", "Citroën", "Opel", "Volkswagen", "Toyota");
        $brands[0] = array("208", "308", "3008", "2008", "508", "5008");
        $brands[1] = array("Clio", "Megane", "Captur", "Twingo", "Scenic");
        $brands[2] = array("C3", "Berlingo", "C4", "DS3");
        $brands[3] = array("Corsa", "Astra", "Mokka");
        $brands[4] = array("Golf", "Polo", "Tiguan", "T-Roc", "Touran");
        $brands[5] = array("Yaris", "RAV 4", "Auris");
        $locations = array("Paris", "Melun", "Evry", "Montgeron", "Juvisy", "Corbeil");
        $engines = array("essence", "diesel", "hybride", "électrique");

        for($i = 0; $i < 100; $i++){
            $car = new Car();
            $currentBrand = rand(0,5);
            $carYear = rand(2000, 2017);
            $date = new \DateTime(($carYear+rand(0,3)).'-'.rand(1,12).'-'.rand(1,28));

            $car->setBrand($brand[$currentBrand])
                ->setModel($brands[$currentBrand][rand(0, (count($brands[$currentBrand])-1))])
                ->setYear($carYear)
                ->setMileage(rand(10000, 250000))
                ->setPrice(rand(5000, 25000))
                ->setLocation($locations[rand(0,5)])
                ->setDateFirst($date)
                ->setEngine($engines[rand(0,3)]);

            $manager->persist($car);
        }

        $manager->flush();
    }
}
