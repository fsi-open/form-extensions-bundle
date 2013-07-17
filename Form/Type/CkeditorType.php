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
                'ui_color' => $options['ui_color'] ? '#' . ltrim($options['ui_color'], '#') : null,
                'width' => $options['width'],
                'height' => $options['height'],
                'force_paste_as_plaintext' => $options['force_paste_as_plaintext'],
                'language' => $options['language'],
                'skin' => $options['skin'],
                'base_href' => $options['base_href'],
                'body_class' => $options['body_class'],
                'body_id' => $options['body_id'],
                'contents_css' => $options['contents_css'],
                'enter_mode' => $options['enter_mode']
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
        ));

        $resolver->setAllowedValues(array(
            'required' => array(false),
            'enter_mode' => array(
                'ENTER_DIV',
                'ENTER_BR',
                'ENTER_P',
                null,
            )
        ));

        $resolver->setAllowedTypes(array(
            'force_paste_as_plaintext' => 'string',
            'toolbar' => 'array',
            'base_href' => array('string', 'null'),
            'body_class' => array('string', 'null'),
            'body_id' => array('string', 'null'),
        ));

        $resolver->setNormalizers(array(
            'force_paste_as_plaintext' => function (Options $options, $value) {
                return ($value) ? 'true' : 'false';
            },
        ));
    }
}