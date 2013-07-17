<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Twig\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormExtensionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('bundles/fsiformextensions/ckeditor/');
    }

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

    function it_have_form_group_function()
    {
        $this->getFunctions()->shouldHaveFunction('form_group');
    }

    function it_have_include_ckeditor_function()
    {
        $this->getFunctions()->shouldHaveFunction('include_ckeditor');
    }

    function it_have_ckeditor_initializer_function()
    {
        $this->getFunctions()->shouldHaveFunction('ckeditor_initializer');
    }

    /**
     * @param \Twig_Environment $env
     * @param \Symfony\Bundle\TwigBundle\Extension\AssetsExtension $assets
     */
    function it_should_not_include_script_twice($env, $assets)
    {
        $assets->getAssetUrl('bundles/fsiformextensions/ckeditor/ckeditor.js')->shouldBeCalledTimes(1);
        $assets->getAssetUrl('bundles/fsiformextensions/ckeditor/')->shouldBeCalledTimes(1);

        $env->hasExtension('assets')->willReturn(true);
        $env->getExtension('assets')->willReturn($assets);
        $this->initRuntime($env);

        $this->includeCkeditor();
        $this->includeCkeditor();
    }

    /**
     * @param \Twig_Environment $env
     * @param \Twig_Template $template
     */
    function it_should_not_add_initializer_twice($env, $template)
    {
        $env->loadTemplate('@FSiFormExtensions/Form/form_div_layout.html.twig')
            ->shouldBeCalledTimes(1)
            ->willReturn($template);

        $template->displayBlock('ckeditor_initializer', array())->shouldBeCalledTimes(1);

        $this->initRuntime($env);
        $this->ckeditorInitializer();
        $this->ckeditorInitializer();
    }

    /**
     * @param \Twig_Environment $env
     * @param \Twig_Template $template
     */
    function it_will_add_initializer_twice_when_forced($env, $template)
    {
        $env->loadTemplate('@FSiFormExtensions/Form/form_div_layout.html.twig')
            ->shouldBeCalledTimes(2)
            ->willReturn($template);

        $template->displayBlock('ckeditor_initializer', array())->shouldBeCalledTimes(2);

        $this->initRuntime($env);
        $this->ckeditorInitializer();
        $this->ckeditorInitializer(true);
    }

    public function getMatchers()
    {
        return array(
            'haveFunction' => function($subject, $key) {
                foreach ($subject as $functionName => $function) {
                    if ($function instanceof \Twig_Function) {
                        if ($functionName == $key) {
                            return true;
                        }
                    }
                }

                return false;
            },
        );
    }
}
