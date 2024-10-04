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
                'label' => 'Nom du burger',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['placeholder' => 'Nom du burger', 'class' => 'form-control mb-3'],
                'required' => true
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['placeholder' => 'Prix du burger', 'class' => 'form-control mb-3', 'type' => 'decimal'],
                'required' => true,
            ])
            ->add('pain', EntityType::class, [
                'label' => 'Pain',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-3'],
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
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-3'],
                'class' => Oignon::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                // pour les relations ManyToMany utiliser by_reference => false
                // 'by_reference' => false
            ])
            ->add('sauces', EntityType::class, [
                'label' => 'Sauces',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-3'],
                'class' => Sauce::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => true,
                'by_reference' => false,
            ])
            ->add('image', EntityType::class, [
                'label' => 'Image',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-3'],
                'class' => Image::class,
                'choice_label' => 'name',
                // 'attr' => ['data-image-target' => 'select', 'data-action' => 'change->image      #preview'],
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
