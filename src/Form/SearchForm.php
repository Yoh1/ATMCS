<?php

namespace App\Form;

use App\Data\SearchData;
use App\Repository\CarRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SearchForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->brands = $options['brands'];
        $this->models = $options['models'];
        $this->locations = $options['locations'];
        $this->engines = $options['engines'];

        $builder
            ->add('q', TextType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Rechercher une voiture",
                    'class' => "p-2"
                ]
            ])
            ->add('brand', ChoiceType::class, [
                'required' => FALSE,
                'choices' => $this->brands,
                'choice_label' => FALSE,
                'expanded' => TRUE,
                'label' => FALSE
            ])
            ->add('minPrice', NumberType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Prix minimum",
                    'class' => "p-2"
                ]
            ])
            ->add('maxPrice', NumberType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Prix maximum",
                    'class' => "p-2"
                ]
            ])
            ->add('model', ChoiceType::class, [
                'required' => FALSE,
                'choices' => $this->models,
                'choice_label' => FALSE,
                'expanded' => TRUE,
                'label' => FALSE
            ])
            ->add('minYear', NumberType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Entre l'année...",
                    'class' => "p-2"
                ]
            ])
            ->add('maxYear', NumberType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "...et l'année",
                    'class' => "p-2"
                ]
            ])
            ->add('location', ChoiceType::class, [
                'required' => FALSE,
                'choices' => $this->locations,
                'choice_label' => FALSE,
                'expanded' => TRUE,
                'label' => FALSE
            ])
            ->add('minMile', NumberType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Kilométrage minimum",
                    'class' => "p-2"
                ]
            ])
            ->add('maxMile', NumberType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Kilométrage maximum",
                    'class' => "p-2"
                ]
            ])
            ->add('engine', ChoiceType::class, [
                'required' => FALSE,
                'choices' => $this->engines,
                'choice_label' => FALSE,
                'expanded' => TRUE,
                'label' => FALSE
            ])
            ->add('filtrer', SubmitType::class, [
                'attr' => [
                    'class' => "btn btn-lg btn-secondary fw-bold",
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'brands' => null,
            'models' => null,
            'locations' => null,
            'engines' => null,
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(){
        
        return '';
    }

}