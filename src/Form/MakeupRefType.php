<?php

namespace App\Form;

use App\Entity\MakeupRef;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MakeupRefType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
             ->add('MakeupProduct', null,
                ['choice_label' => 'name',
                    'label' => 'Makeup'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MakeupRef::class,
        ]);
    }
}
