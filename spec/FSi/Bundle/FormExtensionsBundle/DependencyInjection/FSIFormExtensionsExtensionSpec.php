<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FSIFormExtensionsExtensionSpec extends ObjectBehavior
{
    function it_is_bundle_extension()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\DependencyInjection\Extension');
    }
}
