<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\CarRepository;
use DateTimeInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
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

        $data->brands = $repository->findBrands();
        $data->models = $repository->findModels();
        $data->locations = $repository->findLocations();
        $data->engines = $repository->findEngines();

        $form = $this->createForm(SearchForm::class, $data)
                    ->add('brand', ChoiceType::class, [
                        'required' => FALSE,
                        'choices' => $data->brands,
                        'choice_label' => FALSE,
                        'expanded' => TRUE,
                        'label' => FALSE
                    ])
                    ->add('model', ChoiceType::class, [
                        'required' => FALSE,
                        'choices' => $data->models,
                        'choice_label' => FALSE,
                        'expanded' => TRUE,
                        'label' => FALSE
                    ])
                    ->add('location', ChoiceType::class, [
                        'required' => FALSE,
                        'choices' => $data->locations,
                        'choice_label' => FALSE,
                        'expanded' => TRUE,
                        'label' => FALSE
                    ])
                    ->add('engine', ChoiceType::class, [
                        'required' => FALSE,
                        'choices' => $data->engines,
                        'choice_label' => FALSE,
                        'expanded' => TRUE,
                        'label' => FALSE
                    ]);
        $form->handleRequest($request);

        $cars = $repository->findSearch($data);

        

        return $this->render('research/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView()
        ]);
    }
}
