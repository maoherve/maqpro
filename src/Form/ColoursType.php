<?php

namespace App\Form;

use App\Entity\Colours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ColoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('MakeupProduct', null,
                ['choice_label' => 'name',
                    'label' => 'MakeupProduct'
                ])
            ->add('imageName')
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
            'data_class' => Colours::class,
        ]);
    }
}
