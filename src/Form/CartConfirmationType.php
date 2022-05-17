<?php

namespace App\Form;

use App\Entity\Purchase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CartConfirmationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('full_name', TextType::class, [
                'label' => 'Nom complet',
                'attr' => [
                    'placeholder' => 'Nom complet pour la livraison'
                ]
            ])
            ->add('address', TextareaType::class, [
                'label' => 'Adresse complete',
                'attr' => [
                    'placeholder' => 'Adresse complete pour la livraison'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'code Postal',
                'attr' => [
                    'placeholder' => 'Code postal pour la livraiton'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'ville',
                'attr' => [
                    'placeholder' => 'Ville pour la livraison'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Purchase::class
        ]);
    }
}
