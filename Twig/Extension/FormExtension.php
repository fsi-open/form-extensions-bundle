<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Twig\Extension;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class FormExtension extends \Twig_Extension
{
    /**
     * @var bool
     */
    protected $ckeditorIncluded;

    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @param $basePath
     */
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
        $this->ckeditorIncluded = false;
    }

    /**
     * {@inheritDoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fsi_form_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'form_group' => new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html'))),
            'include_ckeditor' => new \Twig_Function_Method($this, 'includeCkeditor', array('is_safe' => array('html'))),
        );
    }

    public function includeCkeditor()
    {
        if (!$this->environment->hasExtension('assets')) {
            return;
        }

        if (!$this->ckeditorIncluded) {
            $basePath = $this->environment
                ->getExtension('assets')
                ->getAssetUrl($this->basePath);

            $jsPath = $this->environment
                ->getExtension('assets')
                ->getAssetUrl($this->basePath . 'ckeditor.js');

            echo sprintf('<script type="text/javascript" src="%s"></script>', $jsPath);
            echo sprintf('<script>var CKEDITOR_BASEPATH = \'%s\'</script>', $basePath);
            $this->ckeditorIncluded = true;
        }
    }
}
