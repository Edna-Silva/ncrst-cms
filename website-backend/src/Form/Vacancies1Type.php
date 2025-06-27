<?php

namespace App\Form;

use App\Entity\Vacancies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Vacancies1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('department')
            ->add('location')
            ->add('type')
            ->add('level')
            ->add('closing_date')
            ->add('publish_date')
            ->add('salary')
            ->add('create_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vacancies::class,
        ]);
    }
}
