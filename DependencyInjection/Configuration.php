<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\DependencyInjection;

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

        $rootNode
            ->children()
                ->arrayNode('fsi_ckeditor')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('ckeditor_script_path')
                            ->defaultValue('//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.2/ckeditor.js')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}