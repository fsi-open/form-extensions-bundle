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
            'groups' => 'array',
            'group' => array('string', 'null')
        ))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     * @param \Symfony\Component\Form\FormView $view
     * @param \Symfony\Component\Form\FormInterface $childBasic
     * @param \Symfony\Component\Form\FormInterface $childAdditional
     * @param \Symfony\Component\Form\FormConfigInterface $configBasic
     * @param \Symfony\Component\Form\FormConfigInterface $configAdditional
     */
    function it_should_build_view_with_groups_array_in_vars($form, $view, $childBasic, $childAdditional, $configBasic, $configAdditional)
    {
        $configBasic->hasOption('group')->shouldBeCalled()->willReturn(true);
        $configBasic->getOption('group')->shouldBeCalled()->willReturn('basic');

        $childBasic->getName()->shouldBeCalled()->willReturn('child_basic');
        $childBasic->getConfig()->shouldBeCalled()->willReturn($configBasic);

        $configAdditional->hasOption('group')->shouldBeCalled()->willReturn(false);
        $configAdditional->getOption('group')->shouldNotBeCalled();
        $childAdditional->getName()->shouldNotBeCalled();
        $childAdditional->getConfig()->shouldBeCalled()->willReturn($configAdditional);

        $form->all()->shouldBeCalled()->willReturn(array(
            $childBasic,
            $childAdditional
        ));

        $this->buildView($view, $form, array(
            'groups' => array(
                'basic' => 'basic_group_name_translation_key',
            )
        ));
    }
}
