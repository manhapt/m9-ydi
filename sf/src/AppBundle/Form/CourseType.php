<?php

namespace AppBundle\Form;

use AppBundle\Entity\Role;
use Ekino\WordpressBundle\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', EntityType::class, array(
                'class' => Role::class,
                'label' => 'Object',
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded'     => true,
            ))
            ->add('sku', HiddenType::class, [
                'data' => strtoupper(hash('adler32', uniqid(rand(), true))),
            ])
            ->add('name')
            ->add('price', HiddenType::class, ['data' => 0])
            ->add('status', HiddenType::class, ['data' => 1])
            ->add('typeId', HiddenType::class)
            ->add('shortDescription')
            ->add('description', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff'
                )
            ))
            ->add('image', FileType::class, ['required' => false])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Course',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_course';
    }

    /**
     * @param User $entity
     *
     * @return string
     */
    private function filterByContributorUser(User $entity = null)
    {
        if ($entity) {
            $user = new \AppBundle\Entity\UserDecorator($entity);

            return in_array(RoleTypes::CONTRIBUTOR, $user->getRoles())
                ? $user->getEmail() : '';
        }

        return '';
    }
}
