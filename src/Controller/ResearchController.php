<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\CarRepository;
use DateTimeInterface;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $data->brands = $repository->findBrands($data);
        $brands = $data->brands;
        
        $data->models = $repository->findModels($data);
        $models = $data->models;

        $data->locations = $repository->findLocations($data);
        $locations = $data->locations;
        
        $data->engines = $repository->findEngines($data);
        $engines = $data->engines;

        
        $form = $this->createForm(SearchForm::class, $data, [
            'brands' => $data->brands,
            'models' => $data->models,
            'locations' => $data->locations,
            'engines' => $data->engines
        ]);

        $form->handleRequest($request);        

        $cars = $repository->findSearch($data);

        [$minPrice, $maxPrice] = $repository->findMinMaxPrices($data);

        $data->brands = $repository->findBrands($data);
        $data->models = $repository->findModels($data);
        $data->locations = $repository->findLocations($data);
        $data->engines = $repository->findEngines($data);

        if($data->brands !== $brands || $data->models !== $models || $data->locations !== $locations || $data->engines !== $engines) {
            $form = $this->createForm(SearchForm::class, $data, [
                'brands' => $data->brands,
                'models' => $data->models,
                'locations' => $data->locations,
                'engines' => $data->engines
            ]);
        }
        

        if($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('research/_cars.html.twig', ['cars' => $cars]),
                'sorting' => $this->renderView('research/_sorting.html.twig', ['cars' => $cars]),
                'pagination' => $this->renderView('research/_pagination.html.twig', ['cars' => $cars]),
                //'form' => $this->render('research/index.html.twig', ['form' => $form->createView()])
                //'models' => $data->models
                'models' => $this->renderView('research/_models.html.twig', ['models' =>  $data->models])
            ]);
        }

        //dd($data->models);
        

        return $this->render('research/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView(),
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }
}
