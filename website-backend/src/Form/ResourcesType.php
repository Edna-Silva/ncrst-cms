<?php

namespace App\Form;

use App\Entity\Resources;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResourcesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('yer')
            ->add('description')
            ->add('file_type')
            ->add('size')
            ->add('downloads')
            ->add('date')
            ->add('created_at')
            ->add('resource_categories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Resources::class,
        ]);
    }
}
