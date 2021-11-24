<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
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
