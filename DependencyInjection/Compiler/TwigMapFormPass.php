<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class TwigMapFormPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (false === $container->hasParameter('twig.form.resources')) {
            return;
        }

        /** @var array<string, string> $twigFormResources */
        $twigFormResources = $container->getParameter('twig.form.resources');
        $container->setParameter(
            'twig.form.resources',
            array_merge(
                $twigFormResources,
                ['@FSiFormExtensions/Form/form_map_layout.html.twig']
            )
        );
    }
}
