<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Repository\CarRepository;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\User;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(CarRepository $repository, Request $request): Response
    {

        $data = new SearchData();

        $data->brands = $repository->findTopBrands();
        $data->models = $repository->findTopModels();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'brands' => $data->brands,
            'models' => $data->models,
        ]);
    }
}
