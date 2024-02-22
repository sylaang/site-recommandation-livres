<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('shortBiographie', TextareaType::class, [
                'required' => TRUE,
            ])
            ->add('firstImageHome', FileType::class, [
                'label' => false,
    
                'mapped' => false,
    
                'required' => false,
    
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypesMessage' => 'Attention ne pas dépasser 2000k',
                    ])
                ],
            ])
            ->add('imageBiographie', FileType::class, [
                'label' => false,
    
                'mapped' => false,
    
                'required' => false,
    
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypesMessage' => 'Attention ne pas dépasser 2000k',
                    ])
                ],
            ])
            ->add('secondImageBiographie', FileType::class, [
                'label' => false,
    
                'mapped' => false,
    
                'required' => false,
    
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypesMessage' => 'Attention ne pas dépasser 2000k',
                    ])
                ],
            ])
            ->add('imageReseauxSociaux', FileType::class, [
                'label' => false,
    
                'mapped' => false,
    
                'required' => false,
    
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypesMessage' => 'Attention ne pas dépasser 2000k',
                    ])
                ],
            ])

            ->add('biographie', TextareaType::class, [
                'required' => false,
            ])
            ->add('ImgShortBiographie', FileType::class, [
                'label' => false,
    
                'mapped' => false,
    
                'required' => false,
    
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypesMessage' => 'Attention ne pas dépasser 2000k',
                    ])
                ],
            ])

            ->add('biographie', TextareaType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
