<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BurgerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nom du burger'
        ])
        ->add('price', NumberType::class, [
            'label' => 'Prix'
        ])
        ->add('pain', EntityType::class, [
            'label' => 'Pain',
            'class' => Pain::class,
            'choice_label' => 'name',
            'multiple' => false,
            'expanded' => false,
            'required' => true,
            // pour les relations ManyToMany utiliser by_reference => false
            // 'by_reference' => false
        ])
        ->add('oignon', EntityType::class, [
            'label' => 'Oignon',
            'class' => Oignon::class,
            'choice_label' => 'name',
            'multiple' => false,
            'expanded' => false,
            'required' => true,
            // pour les relations ManyToMany utiliser by_reference => false
            // 'by_reference' => false
        ])
        ->add('sauces', EntityType::class, [
            'label' => 'Sauce',
            'class' => Sauce::class,
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true,
            'required' => true,
            // pour les relations ManyToMany utiliser by_reference => false
            'by_reference' => false
        ])
        ->add('image', EntityType::class, [
            'class' => Image::class,
            'choice_label' => 'name', 
            'attr' => ['data-image-preview-target' => 'select', 'data-action' => 'change->image-preview#preview'],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
