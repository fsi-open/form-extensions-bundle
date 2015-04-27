<?php

namespace FSi\FixturesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalleryType extends AbstractType
{
    public function getName()
    {
        return 'gallery';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photos', 'collection', array(
            'type' => new GalleryPhotoType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
        $builder->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FSi\FixturesBundle\Model\Gallery'
        ));
    }
}