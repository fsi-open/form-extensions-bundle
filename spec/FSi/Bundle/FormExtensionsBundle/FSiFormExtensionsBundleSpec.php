<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\FSi\Bundle\FormExtensionsBundle;

use FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler\TwigApiKeyPass;
use FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler\TwigMapFormPass;
use FSi\Bundle\FormExtensionsBundle\DependencyInjection\FSIFormExtensionsExtension;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FSiFormExtensionsBundleSpec extends ObjectBehavior
{
    function it_is_bundle()
    {
        $this->shouldHaveType(Bundle::class);
    }

    function it_has_extension()
    {
        $this->getContainerExtension()->shouldReturnAnInstanceOf(
            FSIFormExtensionsExtension::class
        );
    }

    function it_registers_twig_compiler_pass(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            Argument::type(TwigMapFormPass::class)
        )->shouldBeCalled();

        $container->addCompilerPass(
            Argument::type(TwigApiKeyPass::class)
        )->shouldBeCalled();

        $this->build($container);
    }
}
