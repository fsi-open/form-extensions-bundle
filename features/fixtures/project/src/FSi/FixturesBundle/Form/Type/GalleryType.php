<?php

namespace FSi\FixturesBundle\Form\Type;

use FSi\FixturesBundle\Model\Gallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photos', CollectionType::class, array(
            'entry_type' => GalleryPhotoType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
        $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Gallery::class,
        ));
    }
}