<?php

namespace FSi\FixturesBundle\Form\Type;

use FSi\FixturesBundle\Model\GalleryPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', TextType::class);
        $builder->add('position', TextType::class, array('attr' => array('readonly' => true)));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GalleryPhoto::class,
            'label' => false,
        ));
    }
}
