<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class FSIFormExtensionsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->registerFormConfiguration($config, $container);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    /**
     * Loads Form configuration.
     *
     * @param $config
     * @param ContainerBuilder $container
     */
    private function registerFormConfiguration($config, ContainerBuilder $container)
    {
        $ckeditorOptions = (isset($config['form']['ckeditor']['options']))
            ? $config['form']['ckeditor']['options']
            : array();

        $container->setParameter('fsi_form_extensions.form.type.ckeditor.base_path', $config['form']['ckeditor']['base_path']);
        $container->setParameter('fsi_form_extensions.form.type.ckeditor.config', $ckeditorOptions);
    }
}
