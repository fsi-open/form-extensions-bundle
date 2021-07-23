<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class TwigApiKeyPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (false === $container->hasDefinition('twig')) {
            return;
        }

        $definition = $container->getDefinition('twig');
        $definition->addMethodCall(
            'addGlobal',
            ['fsi_map_api_key', $container->getParameter('fsi_form_extensions.map_api_key')]
        );
    }
}
