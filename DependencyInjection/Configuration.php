<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('fsi_form_extensions');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('fsi_map')
                    ->children()
                        ->scalarNode('api_key')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
