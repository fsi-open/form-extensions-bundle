<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Twig\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FSimapFormExtensionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('abc123');
    }

    function it_is_twig_extension()
    {
        $this->shouldHaveType('Twig_Extension');
    }

    function it_have_name()
    {
        return $this->getName()->shouldReturn('fsi_map_form');
    }

    function it_have_globals()
    {
        $this->getGLobals()->shouldReturn(['fsi_map_api_key' => 'abc123']);
    }
}
