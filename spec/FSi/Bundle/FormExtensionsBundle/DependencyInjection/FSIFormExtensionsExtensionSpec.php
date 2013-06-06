<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FSIFormExtensionsExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FSi\Bundle\FormExtensionsBundle\DependencyInjection\FSIFormExtensionsExtension');
    }

    function it_should_have_a_valid_alias()
    {
        $this->getAlias()->shouldReturn('fsi_form_extensions');
    }

    /**
     *  @param \Symfony\Component\DependencyInjection\ContainerBuilder $builder
     */
    function it_should_register_ckeditor_configuration_parameter($builder)
    {
        $options = array('form' => array());

        $builder->setParameter('fsi_form_extensions.form.type.ckeditor.config', array())->shouldBeCalled();
        $this->shouldThrow('\InvalidArgumentException')->duringLoad($options, $builder);
    }
}
