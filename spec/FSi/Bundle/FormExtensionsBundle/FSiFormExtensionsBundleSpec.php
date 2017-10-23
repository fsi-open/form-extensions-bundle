<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\FSi\Bundle\FormExtensionsBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FSiFormExtensionsBundleSpec extends ObjectBehavior
{
    function it_is_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    function it_have_extension()
    {
        $this->getContainerExtension()->shouldReturnAnInstanceOf(
            'FSi\Bundle\FormExtensionsBundle\DependencyInjection\FSIFormExtensionsExtension'
        );
    }

    function it_register_twig_compiler_pass(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            Argument::type('FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler\TwigMapFormPass')
        )->shouldBeCalled();

        $this->build($container);
    }
}
