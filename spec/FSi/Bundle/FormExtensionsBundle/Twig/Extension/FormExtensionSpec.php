<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Twig\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FSi\Bundle\FormExtensionsBundle\Twig\Extension\FormExtension');
    }

    function it_should_be_a_twig_extension()
    {
        $this->shouldHaveType('Twig_Extension');
    }

    function it_should_have_a_name()
    {
        $this->getName()->shouldReturn('fsi_form_extension');
    }

    function it_should_have_the_form_grouping_functions()
    {
        $this->getFunctions()->shouldHaveCount(2);
    }

    /**
     * @param \Twig_Environment $env
     * @param \Symfony\Bundle\TwigBundle\Extension\AssetsExtension $assets
     */
    function it_should_not_include_script_twice($env, $assets)
    {
        $assets->getAssetUrl('bundles/fsiformextensions/ckeditor/ckeditor.js')->shouldBeCalledTimes(1);

        $env->hasExtension('assets')->willReturn(true);
        $env->getExtension('assets')->willReturn($assets);
        $this->initRuntime($env);

        $this->includeCkeditor();
        $this->includeCkeditor();
    }
}
