<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fsi_form_extensions');

        $this->addFormSection($rootNode);

        return $treeBuilder;
    }

    private function addFormSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('form')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('ckeditor')
                            ->info('ckeditor type global configuration')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('base_path')->defaultValue('bundles/fsiformextensions/ckeditor/')->end()
                                ->arrayNode('options')
                                    ->children()
                                        ->scalarNode('uiColor')->end()
                                        ->booleanNode('forcePasteAsPlainText')->end()
                                        ->scalarNode('language')->end()
                                        ->scalarNode('width')->end()
                                        ->scalarNode('height')->end()
                                        ->scalarNode('skin')->end()
                                        ->scalarNode('baseHref')->end()
                                        ->scalarNode('bodyClass')->end()
                                        ->scalarNode('bodyId')->end()
                                        ->scalarNode('contentsCss')->end()
                                        ->scalarNode('enterMode')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
