<?php

namespace App\Form;

use App\Entity\Makeup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class MakeupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'download_label' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'asset_helper' => false,
                'label' => 'Fichier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Makeup::class,
        ]);
    }
}
