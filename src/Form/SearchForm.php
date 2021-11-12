<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Rechercher une voiture",
                    'class' => "p-2"
                ]
            ])
            ->add('min', NumberType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Prix minimum",
                    'class' => "p-2"
                ]
            ])
            ->add('max', NumberType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Prix maxium",
                    'class' => "p-2"
                ]
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
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(){
        
        return '';
    }

}