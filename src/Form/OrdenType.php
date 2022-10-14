<?php

namespace App\Form;

use App\Entity\CarritoDetalle;
use App\Entity\Orden;
use App\Entity\OrdenDetalle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('precioTotal')
            ->add('cliente')
            ->add('detalles', CollectionType::class, [
                'required' => true,
                'entry_type' => OrdenDetalleType::class,
                'prototype_data' => new OrdenDetalle(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orden::class,
        ]);
    }
}