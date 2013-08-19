<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Form\Type;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class CkeditorType extends AbstractType
{
    /**
     * @var array
     */
    protected $globalOptions;

    /**
     * @param array $globalOptions
     */
    public function __construct($globalOptions = array())
    {
        $this->globalOptions = $globalOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'textarea';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ckeditor';
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
         $config = array_merge(
            array(
                'toolbar' => $options['toolbar'],
                'uiColor' => $options['uiColor'] ? '#' . ltrim($options['uiColor'], '#') : null,
                'width' => $options['width'],
                'height' => $options['height'],
                'forcePasteAsPlainText' => $options['forcePasteAsPlainText'],
                'language' => $options['language'],
                'skin' => $options['skin'],
                'base_href' => $options['baseHref'],
                'bodyClass' => $options['bodyClass'],
                'bodyId' => $options['bodyId'],
                'contentsCss' => $options['contentsCss'],
                'enterMode' => $options['enterMode']
            ),
            $this->globalOptions
        );

        $view->vars['ckeditor_config'] = array_filter($config);
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
            'forcePasteAsPlainText' => 'string',
            'toolbar' => 'array',
            'baseHref' => array('string', 'null'),
            'bodyClass' => array('string', 'null'),
            'contentsCss' => array('string', 'null'),
            'bodyId' => array('string', 'null'),
        ));

        $resolver->setNormalizers(array(
            'forcePasteAsPlainText' => function (Options $options, $value) {
                return ($value) ? 'true' : 'false';
            },
        ));
    }
}