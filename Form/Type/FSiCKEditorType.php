<?php

namespace FSi\Bundle\FormExtensionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FSiCKEditorType extends AbstractType
{
    /**
     * @return string|void
     */
    public function getName()
    {
        return 'fsi_ckeditor';
    }

    public function getParent()
    {
        return 'textarea';
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $ckeditorOptions = array(
            'required' => $options['required'],
            'uiColor' => $options['uiColor'] ? '#' . ltrim($options['uiColor'], '#') : null,
            'forcePasteAsPlainText' => $options['forcePasteAsPlainText'],
            'language' => $options['language'],
            'toolbar' => $options['toolbar'],
            'width' => $options['width'],
            'height' => $options['height'],
            'baseHref' => $options['baseHref'],
            'bodyClass' => $options['bodyClass'],
            'bodyId' => $options['bodyId'],
            'contentsCss' => $options['contentsCss'],
            'enterMode' => $options['enterMode'],
            'format_tags' => $options['formatTags'],
            'font_names' => $options['fontNames'],
            'fontSize_sizes' => $options['fontSizeSizes'],
        );
        $view->vars['ckeditor_config'] = array_filter($ckeditorOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
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
        ));

        $resolver->setAllowedValues(array(
            'required' => array(false),
            'enterMode' => array(
                'ENTER_DIV',
                'ENTER_BR',
                'ENTER_P',
                null,
            )
        ));

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
        ));

        $resolver->setNormalizers(array(
            'forcePasteAsPlainText' => function (Options $options, $value) {
                    return ($value) ? 'true' : 'false';
                },
        ));
    }
}
