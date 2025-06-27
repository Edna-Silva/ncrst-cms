<?php

namespace App\Form;

use App\Entity\NewsArticles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('excerpt')
            ->add('content')
            ->add('read_time')
            ->add('image_url')
            ->add('featured')
            ->add('created_at')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsArticles::class,
        ]);
    }
}
