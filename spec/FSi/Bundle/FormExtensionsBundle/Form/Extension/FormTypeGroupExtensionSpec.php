<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormTypeGroupExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FSi\Bundle\FormExtensionsBundle\Form\Extension\FormTypeGroupExtension');
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    function it_should_set_valid_default_options($resolver)
    {
        $resolver->setDefaults(array(
            'groups' => array(),
            'group' => null
        ))->shouldBeCalled();

        $resolver->setAllowedTypes(array(
            'group' => array('string', 'null')
        ))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     * @param \Symfony\Component\Form\FormView $view
     * @param \Symfony\Component\Form\FormInterface $childBasic
     * @param \Symfony\Component\Form\FormInterface $childAdd
     * @param \Symfony\Component\Form\FormConfigInterface $configBasic
     * @param \Symfony\Component\Form\FormConfigInterface $configAdd
     */
    function it_should_build_view_with_groups_array_in_vars($form, $view, $childBasic, $childAdd, $configBasic, $configAdd)
    {
        $configBasic->hasOption('group')->shouldBeCalled()->willReturn(true);
        $configBasic->getOption('group')->shouldBeCalled()->willReturn('basic');

        $childBasic->getName()->shouldBeCalled()->willReturn('child_basic');
        $childBasic->getConfig()->shouldBeCalled()->willReturn($configBasic);

        $configAdd->hasOption('group')->shouldBeCalled()->willReturn(false);
        $configAdd->getOption('group')->shouldNotBeCalled();
        $childAdd->getName()->shouldNotBeCalled();
        $childAdd->getConfig()->shouldBeCalled()->willReturn($configAdd);

        $form->all()->shouldBeCalled()->willReturn(array(
            $childBasic,
            $childAdd
        ));

        $this->buildView($view, $form, array(
            'groups' => array(
                'basic',
            )
        ));
    }
}
