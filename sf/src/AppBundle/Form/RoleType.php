<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('status')
            ->add('name', ChoiceType::class, [
                'choices' => [
                    ucfirst(RoleTypes::SUBSCRIBER) => RoleTypes::SUBSCRIBER,
                    ucfirst(RoleTypes::CONTRIBUTOR) => RoleTypes::CONTRIBUTOR
                ],
            ])
            ->add('resource', null, ['data' => 'course'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Role'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_role';
    }
}
