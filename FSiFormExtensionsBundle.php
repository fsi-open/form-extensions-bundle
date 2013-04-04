<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle;

use FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler\TwigFormPass;
use FSi\Bundle\FormExtensionsBundle\DependencyInjection\FSIFormExtensionsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class FSiFormExtensionsBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigFormPass());
    }

    /**
     * @return FSIAdminExtension|null|\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FSIFormExtensionsExtension();
        }

        return $this->extension;
    }
}
