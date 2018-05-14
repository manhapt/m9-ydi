<?php

namespace AppBundle\Form;

use AppBundle\Entity\Role;
use Doctrine\ORM\EntityRepository;
use Ekino\WordpressBundle\Entity\User;
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
            ->add('sku', null, [
                'data' => strtoupper(hash('adler32', uniqid(rand(), true)))
            ])
            ->add('name')
            ->add('price', HiddenType::class, ['data' => 0])
            ->add('status', null, ['data' => 1])
            ->add('typeId', HiddenType::class)
            ->add('description')
            ->add('shortDescription')
            ->add('image', FileType::class, ['required' => false])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Course'
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
