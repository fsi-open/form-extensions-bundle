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
                    ->children()
                        ->arrayNode('ckeditor')
                            ->info('ckeditor type global configuration')
                            ->children()
                                ->scalarNode('ui_color')->end()
                                ->booleanNode('force_paste_as_plaintext')->end()
                                ->scalarNode('language')->end()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('skin')->end()
                                ->scalarNode('base_href')->end()
                                ->scalarNode('body_class')->end()
                                ->scalarNode('body_id')->end()
                                ->scalarNode('contents_css')->end()
                                ->scalarNode('enter_mode')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
