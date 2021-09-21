<?php

namespace App\Form;

use App\Entity\MakeupRefDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MakeupRefDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('MakeupRef', null,
                ['choice_label' => 'name',
                    'label' => 'MakeupRef'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MakeupRefDetails::class,
        ]);
    }
}
