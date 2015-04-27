<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FSiCKEditorTypeSpec extends ObjectBehavior
{
    function it_is_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    function it_have_name()
    {
        $this->getName()->shouldReturn('fsi_ckeditor');
    }

    function it_is_child_of_textarea()
    {
        $this->getParent()->shouldReturn('textarea');
    }

    function it_set_default_options(OptionsResolver $resolver)
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
                array('name' => 'links', 'items' => array('Link', 'Unlink', '-', 'Image')),
                '/',
                array('name' => 'styles', 'items' => array('Format')),
            ),
            'width' => null,
            'height' => null,
            'baseHref' => '',
            'bodyClass' => null,
            'bodyId' => null,
            'contentsCss' => null,
            'enterMode' => null,
            'formatTags' => null,
            'fontNames' => null,
            'fontSizeSizes' => null,
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
            'forcePasteAsPlainText' => 'bool',
            'toolbar' => 'array',
            'baseHref' => 'string',
            'bodyClass' => array('string', 'null'),
            'contentsCss' => array('string', 'null'),
            'bodyId' => array('string', 'null'),
            'formatTags' => array('string', 'null'),
            'fontNames' => array('string', 'null'),
            'fontSizeSizes' => array('string', 'null'),
        ))->shouldBeCalled();

        $resolver->setNormalizers(Argument::type('array'))->shouldBeCalled();


        $this->setDefaultOptions($resolver);
    }
}
