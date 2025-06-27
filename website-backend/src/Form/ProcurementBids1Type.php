<?php

namespace App\Form;

use App\Entity\ProcurementBids;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcurementBids1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('category')
            ->add('reference')
            ->add('description')
            ->add('value')
            ->add('closing_date')
            ->add('publish_date')
            ->add('status')
            ->add('is_awarded')
            ->add('vendor')
            ->add('awarded_value')
            ->add('awarded_date')
            ->add('contract_period')
            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProcurementBids::class,
        ]);
    }
}
