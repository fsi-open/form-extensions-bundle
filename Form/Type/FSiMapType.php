<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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

        $fieldOptions = array_merge($this->getDefaultZoomOptions(), $options['zoom_options']);
        $builder->add($options['zoom_name'], $options['zoom_type'], $fieldOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
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
            'zoom_name' => 'zoom',
            'zoom_type' => 'number',
            'zoom_options' => array(),
        ]);

        $resolver->setAllowedTypes(array(
            'latitude_name' => 'string',
            'latitude_type' => 'string',
            'latitude_options' => 'array',
            'longitude_name' => 'string',
            'longitude_type' => 'string',
            'longitude_options' => 'array',
            'zoom_name' => 'string',
            'zoom_type' => 'string',
            'zoom_options' => 'array',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fsi_map';
    }

    /**
     * @return array
     */
    private function getDefaultLatitudeOptions()
    {
        return array(
            'label' => 'map.latitude',
        );
    }

    /**
     * @return array
     */
    private function getDefaultLongitudeOptions()
    {
        return array(
            'label' => 'map.longitude',
        );
    }

    /**
     * @return array
     */
    private function getDefaultZoomOptions()
    {
        return array(
            'label' => 'map.zoom',
        );
    }
}
