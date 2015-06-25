<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TwigFormPassSpec extends ObjectBehavior
{
    function it_is_compiler_pass()
    {
        $this->shouldImplement('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface');
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    function it_do_nothing_when_form_resources_are_missing($container)
    {
        $container->hasParameter('twig.form.resources')->shouldBeCalled()->willReturn(false);
        $this->process($container)->shouldReturn(null);
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    function it_add_ckeditor_form_layout_to_form_resources_param($container)
    {
        $container->hasParameter('twig.form.resources')->shouldBeCalled()->willReturn(true);
        $container->getParameter('twig.form.resources')->shouldBeCalled()->willReturn(array());

        $container->setParameter('twig.form.resources', array('@FSiFormExtensions/Form/form_ckeditor_layout.html.twig'))
            ->shouldBeCalled();

        $this->process($container)->shouldReturn(null);
    }
}
