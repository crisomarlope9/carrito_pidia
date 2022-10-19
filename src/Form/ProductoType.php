<?php

namespace App\Form;

use App\Entity\CarritoDetalle;
use App\Entity\Producto;
use CarlosChininin\FileUpload\Form\ImageFileUploadFormType;
use CarlosChininin\FileUpload\Model\FileUpload;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;




class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',TextType::class,[])
            ->add('categoria')
            ->add('marca')
            ->add('precio',TextType::class,[])
            ->add('stock' ,NumberType::class,[])
            ->add('descripcion',TextareaType::class,[
                'required'=>false])
            ->add('foto',ImageFileUploadFormType::class,[
                'required'=>false])
            ->add('imagenes',CollectionType::class, [
                'required' => false,
                'entry_type' => ImageFileUploadFormType::class,
                'prototype_data' => new FileUpload(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
