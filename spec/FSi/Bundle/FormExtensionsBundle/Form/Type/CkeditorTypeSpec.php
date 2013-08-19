<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CkeditorTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FSi\Bundle\FormExtensionsBundle\Form\Type\CkeditorType');
    }

    function it_has_valid_name()
    {
        $this->getName()->shouldReturn('ckeditor');
    }

    function it_is_child_of_textarea()
    {
        $this->getParent()->shouldReturn('textarea');
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    function it_set_valid_default_options($resolver)
    {
        $resolver->setDefaults(array(
            'required' => false,
            'uiColor' => null,
            'forcePasteAsPlainText' => true,
            'language' => 'pl',
            'toolbar' => array(
                array('name' => 'document', 'items' => array('Source', '-', 'NewPage', '-', 'Templates' )),
                array('name' => 'clipboard', 'items' => array('Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' )),
                '/',
                array(
                    'name' => 'basicstyles',
                    'items' => array(
                        'Bold', 'Italic', 'Underline', 'Strike', '-',
                        'Table', 'NumberedList', 'BulletedList', '-',
                        'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock')
                ),
                array('name' => 'links', 'items' => array('Link', 'Unlink', '-', 'Image'))
            ),
            'width' => null,
            'height' => null,
            'skin' => null,
            'baseHref' => null,
            'bodyClass' => null,
            'bodyId' => null,
            'contentsCss' => null,
            'enterMode' => null,
        ))->shouldBeCalled();

        $resolver->setAllowedValues(array(
            'required' => array(false),
            'enterMode' => array(
                'ENTER_DIV',
                'ENTER_BR',
                'ENTER_P',
                null,
            )
        ))->shouldBeCalled();

        $resolver->setAllowedTypes(array(
            'uiColor' => array('string', 'null'),
            'forcePasteAsPlainText' => 'string',
            'toolbar' => 'array',
            'baseHref' => array('string', 'null'),
            'bodyClass' => array('string', 'null'),
            'contentsCss' => array('string', 'null'),
            'bodyId' => array('string', 'null'),
        ))->shouldBeCalled();

        $resolver->setNormalizers(Argument::type('array'))->shouldBeCalled();


        $this->setDefaultOptions($resolver);
    }
}
