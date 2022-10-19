<?php

namespace App\Form;

use App\Entity\Carrito;
use App\Entity\CarritoDetalle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarritoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('cliente')
            ->add('detalles',CollectionType::class, [
                'required' => true,
                'entry_type' => CarritoDetalleType::class,
                'prototype_data' => new CarritoDetalle(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carrito::class,
        ]);
    }
}
