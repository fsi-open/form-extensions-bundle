<?php

/**
 * (c) FSi sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle;

use FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler\TwigFormPass;
use FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler\TwigMapFormPass;
use FSi\Bundle\FormExtensionsBundle\DependencyInjection\FSIFormExtensionsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class FSiFormExtensionsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TwigMapFormPass());
    }

    /**
     * @return FSIFormExtensionsExtension|null|\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FSIFormExtensionsExtension();
        }

        return $this->extension;
    }
}
