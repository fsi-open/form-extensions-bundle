<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\Type;

use PhpSpec\ObjectBehavior;

class FSiMapTypeSpec extends ObjectBehavior
{
    public function it_is_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    public function it_has_name()
    {
        $this->getName()->shouldReturn('fsi_map');
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function it_set_options($resolver)
    {
        $resolver->setDefaults([
            'inherit_data' => true,
            'translation_domain' => 'FSiFormExtensionsBundle',
            'latitude_name' => 'latitude',
            'latitude_type' => 'number',
            'latitude_options' => array(),
            'longitude_name' => 'longitude',
            'longitude_type' => 'number',
            'longitude_options' => array(),
            'zoom_name' => null,
            'zoom_type' => 'number',
            'zoom_options' => array(),
        ])->shouldBeCalled();

        $resolver->setAllowedTypes([
            'latitude_name' => 'string',
            'latitude_type' => 'string',
            'latitude_options' => 'array',
            'longitude_name' => 'string',
            'longitude_type' => 'string',
            'longitude_options' => 'array',
            'zoom_name' => array('string', 'null'),
            'zoom_type' => 'string',
            'zoom_options' => 'array',
        ])->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     */
    public function it_build_form_with_default_options($builder)
    {
        $builder->add('latitude', 'integer', [
            'label' => 'map.latitude',
            'attr' => ['class' => 'latitude-field'],
        ])->shouldBeCalled();
        $builder->add('longitude', 'text', [
            'label' => 'map.longitude',
            'attr' => ['class' => 'longitude-field'],
        ])->shouldBeCalled();
        $builder->add('zoom', 'textarea', [
            'label' => 'map.zoom',
            'attr' => ['class' => 'zoom-field'],
        ])->shouldBeCalled();

        $this->buildForm($builder, [
            'latitude_name' => 'latitude',
            'latitude_type' => 'integer',
            'latitude_options' => array(),
            'longitude_name' => 'longitude',
            'longitude_type' => 'text',
            'longitude_options' => array(),
            'zoom_name' => 'zoom',
            'zoom_type' => 'textarea',
            'zoom_options' => array(),
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     */
    public function it_build_form_with_merged_options($builder)
    {
        $builder->add('lat', 'integer', [
            'label' => 'xyz.lat',
            'label_attr' => ['class' => 'lorem'],
            'attr' => ['class' => 'latitude-field'],
        ])->shouldBeCalled();
        $builder->add('lng', 'text', [
            'label' => 'xyz.lng',
            'label_attr' => ['class' => 'ipsum'],
            'attr' => ['class' => 'longitude-field'],
        ])->shouldBeCalled();
        $builder->add('z', 'textarea', [
            'label' => 'xyz.z',
            'label_attr' => ['class' => 'dolor'],
            'attr' => ['class' => 'zoom-field'],
        ])->shouldBeCalled();

        $this->buildForm($builder, [
            'latitude_name' => 'lat',
            'latitude_type' => 'integer',
            'latitude_options' => array(
                'label' => 'xyz.lat',
                'label_attr' => ['class' => 'lorem'],
            ),
            'longitude_name' => 'lng',
            'longitude_type' => 'text',
            'longitude_options' => array(
                'label' => 'xyz.lng',
                'label_attr' => ['class' => 'ipsum'],
            ),
            'zoom_name' => 'z',
            'zoom_type' => 'textarea',
            'zoom_options' => array(
                'label' => 'xyz.z',
                'label_attr' => ['class' => 'dolor'],
            ),
        ]);
    }
}
