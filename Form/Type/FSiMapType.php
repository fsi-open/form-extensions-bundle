<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FSiMapType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fieldOptions = array_merge($this->getDefaultLatitudeOptions(), $options['latitude_options']);
        $builder->add($options['latitude_name'], $options['latitude_type'], $fieldOptions);

        $fieldOptions = array_merge($this->getDefaultLongitudeOptions(), $options['longitude_options']);
        $builder->add($options['longitude_name'], $options['longitude_type'], $fieldOptions);

        if (!empty($options['zoom_name'])) {
            $fieldOptions = array_merge($this->getDefaultZoomOptions(), $options['zoom_options']);
            $builder->add($options['zoom_name'], $options['zoom_type'], $fieldOptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
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
        ]);

        $resolver->setAllowedTypes('latitude_name', 'string');
        $resolver->setAllowedTypes('latitude_type', 'string');
        $resolver->setAllowedTypes('latitude_options', 'array');
        $resolver->setAllowedTypes('longitude_name', 'string');
        $resolver->setAllowedTypes('longitude_type', 'string');
        $resolver->setAllowedTypes('longitude_options', 'array');
        $resolver->setAllowedTypes('zoom_name', ['string', 'null']);
        $resolver->setAllowedTypes('zoom_type', 'string');
        $resolver->setAllowedTypes('zoom_options', 'array');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fsi_map';
    }

    /**
     * @return array
     */
    private function getDefaultLatitudeOptions()
    {
        return [
            'label' => 'map.latitude',
            'attr' => [
                'class' => 'latitude-field',
            ],
        ];
    }

    /**
     * @return array
     */
    private function getDefaultLongitudeOptions()
    {
        return [
            'label' => 'map.longitude',
            'attr' => [
                'class' => 'longitude-field',
            ],
        ];
    }

    /**
     * @return array
     */
    private function getDefaultZoomOptions()
    {
        return [
            'label' => 'map.zoom',
            'attr' => [
                'class' => 'zoom-field',
            ],
        ];
    }
}
