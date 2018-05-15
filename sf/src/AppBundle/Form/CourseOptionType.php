<?php

namespace AppBundle\Form;

use AppBundle\Entity\Asset;
use AppBundle\Entity\Course;
use AppBundle\Repository\AssetRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CourseOptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Course $course */
        $course = $builder->getData()->getCourse();
        $builder->add('title')
            ->add('required')
            ->add('position')
            ->add('course', EntityType::class, array(
                'class' => Course::class,
                'choice_label' => 'name',
                'label' => 'Course',
                'multiple' => false,
                'disabled' => true,
            ))
            ->add('assets', EntityType::class, array(
                'class' => Asset::class,
                'query_builder' => function (AssetRepository $er) use ($course) {
                    $associatedAssetIds = [];
                    foreach ($er->findByCourse($course) as $asset) {
                        $associatedAssetIds[] = $asset->getId();
                    }
                    return $er->createQueryBuilder('a')
                        ->where('a.id NOT IN ('.implode(',', $associatedAssetIds).')')
                        ->orderBy('a.created', 'DESC');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => true,
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CourseOption',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_courseoption';
    }
}
