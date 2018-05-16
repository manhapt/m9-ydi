<?php

namespace AppBundle\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('uuid', HiddenType::class, [
            'data' => strtoupper(hash('adler32', uniqid(rand(), true))),
        ])
            ->add('state', HiddenType::class, ['data' => 1])
            ->add('name', HiddenType::class, ['data' => 'name'])
            ->add('title')
            ->add('description', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff'
                )
            ))
            ->add('options', HiddenType::class, ['data' => 1])
            ->add('formatOption', HiddenType::class, ['data' => 1])
            ->add('uri', HiddenType::class)
            ->add('storageAccountName', HiddenType::class)
            ->add('alternateId', HiddenType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Asset',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_asset';
    }
}
