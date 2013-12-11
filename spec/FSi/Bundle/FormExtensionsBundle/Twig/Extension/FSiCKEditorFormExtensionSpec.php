<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Twig\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FSiCKEditorFormExtensionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('//ckeditor.com/script.js');
    }

    function it_is_twig_extension()
    {
        $this->shouldHaveType('Twig_Extension');
    }

    function it_have_name()
    {
        return $this->getName()->shouldReturn('fsi_ckeditor_form');
    }

    function it_have_functions()
    {
        $this->getFunctions()->shouldHaveKey('fsi_ckeditor_include');
        $this->getFunctions()->shouldHaveKey('fsi_ckeditor_initialize');
    }

    function it_include_ckeditor_only_once()
    {
        $this->includeCkeditor()->shouldReturn('<script src="//ckeditor.com/script.js"></script>');
        $this->includeCkeditor()->shouldReturn(null);
    }
}

