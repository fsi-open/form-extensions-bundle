<?php

namespace FSi\FixturesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalleryPhotoType extends AbstractType
{
    public function getName()
    {
        return 'gallery_photo';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', 'text');
        $builder->add('position', 'text', array('attr' => array('readonly' => true)));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FSi\FixturesBundle\Model\GalleryPhoto',
            'label' => false
        ));
    }
}
