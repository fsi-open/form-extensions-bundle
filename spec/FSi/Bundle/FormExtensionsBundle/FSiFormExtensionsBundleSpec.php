<?php

namespace spec\FSi\Bundle\FormExtensionsBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FSiFormExtensionsBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle');
    }

    function it_has_valid_extension()
    {
        $this->getContainerExtension()->shouldReturnAnInstanceOf('FSi\Bundle\FormExtensionsBundle\DependencyInjection\FSIFormExtensionsExtension');
    }
}
