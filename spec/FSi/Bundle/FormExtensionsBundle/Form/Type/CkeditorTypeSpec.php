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
            'ui_color' => '#AADC6E',
            'force_paste_as_plaintext' => true,
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
            'base_href' => null,
            'body_class' => null,
            'body_id' => null,
            'contents_css' => null,
            'enter_mode' => null,
        ))->shouldBeCalled();

        $resolver->setAllowedValues(array(
            'required' => array(false),
            'enter_mode' => array(
                'ENTER_DIV',
                'ENTER_BR',
                'ENTER_P',
                null,
            )
        ))->shouldBeCalled();

        $resolver->setAllowedTypes(array(
            'force_paste_as_plaintext' => 'string',
            'toolbar' => 'array',
            'base_href' => array('string', 'null'),
            'body_class' => array('string', 'null'),
            'body_id' => array('string', 'null'),
        ))->shouldBeCalled();

        $resolver->setNormalizers(Argument::type('array'))->shouldBeCalled();


        $this->setDefaultOptions($resolver);
    }
}
