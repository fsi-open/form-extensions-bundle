<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle;

use FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler\TwigApiKeyPass;
use FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler\TwigMapFormPass;
use FSi\Bundle\FormExtensionsBundle\DependencyInjection\FSIFormExtensionsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FSiFormExtensionsBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new TwigMapFormPass());
        $container->addCompilerPass(new TwigApiKeyPass());
    }

    public function getContainerExtension(): ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new FSIFormExtensionsExtension();
        }

        return $this->extension;
    }
}
