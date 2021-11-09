<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class,[
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => "Rechercher une voiture",
                    'class' => "p-2 m-3"
                ]
            ])
            ->add('search', SubmitType::class, [
                'attr' => [
                    'class' => "btn btn-lg btn-secondary fw-bold m-3",
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