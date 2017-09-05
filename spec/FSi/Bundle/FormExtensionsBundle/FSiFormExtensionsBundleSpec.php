<?php

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
