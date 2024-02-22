<?php

namespace App\Form;

use App\Entity\Livre;
use App\Form\AchatUrlType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('couverture', FileType::class, [
            'label' => 'Choisissez une couverture pour votre livre',

            'mapped' => false,

            'required' => false,

            'constraints' => [
                new File([
                    'maxSize' => '2000k',
                    'mimeTypesMessage' => 'Attention ne pas dépasser 2000k',
                ])
            ],
        ])
            ->add('titre')
            ->add('shortDescription')
            ->add('description')
            ->add('nbrPage')
            ->add('auteur')
            ->add('genre')
            ->add('achatUrls', CollectionType::class, [
                'entry_type' => AchatUrlType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true, // Supprime les champs URL d'achat vides
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__achat_urls_prototype__', // Ajoutez ce paramètre dans votre CollectionType
                'attr' => [
                    'class' => 'achat-url-collection', // Ajoutez une classe CSS pour cibler ces champs
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
