<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FSiMapTypeSpec extends ObjectBehavior
{
    public function it_is_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    public function it_set_options(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'inherit_data' => true,
            'translation_domain' => 'FSiFormExtensionsBundle',
            'latitude_name' => 'latitude',
            'latitude_type' => NumberType::class,
            'latitude_options' => [],
            'longitude_name' => 'longitude',
            'longitude_type' => NumberType::class,
            'longitude_options' => [],
            'zoom_name' => null,
            'zoom_type' => NumberType::class,
            'zoom_options' => [],
        ])->shouldBeCalled();

        $resolver->setAllowedTypes('latitude_name', 'string')->shouldBeCalled();
        $resolver->setAllowedTypes('latitude_type', 'string')->shouldBeCalled();
        $resolver->setAllowedTypes('latitude_options', 'array')->shouldBeCalled();
        $resolver->setAllowedTypes('longitude_name', 'string')->shouldBeCalled();
        $resolver->setAllowedTypes('longitude_type', 'string')->shouldBeCalled();
        $resolver->setAllowedTypes('longitude_options', 'array')->shouldBeCalled();
        $resolver->setAllowedTypes('zoom_name', ['string', 'null'])->shouldBeCalled();
        $resolver->setAllowedTypes('zoom_type', 'string')->shouldBeCalled();
        $resolver->setAllowedTypes('zoom_options', 'array')->shouldBeCalled();

        $this->configureOptions($resolver);
    }

    public function it_build_form_with_default_options(FormBuilderInterface $builder)
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
            'latitude_options' => [],
            'longitude_name' => 'longitude',
            'longitude_type' => 'text',
            'longitude_options' => [],
            'zoom_name' => 'zoom',
            'zoom_type' => 'textarea',
            'zoom_options' => [],
        ]);
    }

    public function it_build_form_with_merged_options(FormBuilderInterface $builder)
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
            'latitude_options' => [
                'label' => 'xyz.lat',
                'label_attr' => ['class' => 'lorem'],
            ],
            'longitude_name' => 'lng',
            'longitude_type' => 'text',
            'longitude_options' => [
                'label' => 'xyz.lng',
                'label_attr' => ['class' => 'ipsum'],
            ],
            'zoom_name' => 'z',
            'zoom_type' => 'textarea',
            'zoom_options' => [
                'label' => 'xyz.z',
                'label_attr' => ['class' => 'dolor'],
            ],
        ]);
    }
}
