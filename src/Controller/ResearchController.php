<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\CarRepository;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ResearchController extends AbstractController
{
    /**
     * @Route("/research", name="research")
     */
    public function index(CarRepository $repository, Request $request): Response
    { 

        $data = new SearchData();
        $data->page = $request->get('page', 1);

        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);

        $cars = $repository->findSearch($data);

        return $this->render('research/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView()
        ]);
    }
}
