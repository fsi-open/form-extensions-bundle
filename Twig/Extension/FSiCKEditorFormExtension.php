<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Twig\Extension;

class FSiCKEditorFormExtension extends \Twig_Extension
{
    /**
     * @var bool
     */
    protected $ckeditorIncluded;

    /**
     * @var string
     */
    protected $ckeditorPath;

    /**
     * @param $ckeditorPath
     */
    function __construct($ckeditorPath)
    {
        $this->ckeditorPath = $ckeditorPath;
        $this->ckeditorIncluded = false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fsi_ckeditor_form';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'fsi_ckeditor_include' => new \Twig_Function_Method(
                $this,
                'includeCkeditor',
                array('is_safe' => array('html'))
            ),
            'fsi_ckeditor_initialize' => new \Twig_Function_Node(
                'Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode',
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * @return string
     */
    public function includeCkeditor()
    {
        if ($this->ckeditorIncluded) {
            return;
        }

        $this->ckeditorIncluded = true;
        return sprintf('<script src="%s"></script>', $this->ckeditorPath);
    }
}
