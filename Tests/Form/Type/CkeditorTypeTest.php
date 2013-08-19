<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Tests\Form\Type;

use FSi\Bundle\FormExtensionsBundle\Tests\Fixtures\Form\Extension\CkeditorExtension;
use FSi\Bundle\FormExtensionsBundle\Tests\Fixtures\Form\Extension\GroupExtension;
use FSi\Bundle\FormExtensionsBundle\Twig\Extension\FormExtension as TwigGroupExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bridge\Twig\Tests\Extension\Fixtures\StubFilesystemLoader;
use Symfony\Bridge\Twig\Tests\Extension\Fixtures\StubTranslator;
use Symfony\Bundle\TwigBundle\Extension\AssetsExtension;
use Symfony\Component\Form\Test\FormIntegrationTestCase;
use Symfony\Component\Templating\Helper\AssetsHelper;

class CkeditorTypeTest extends FormIntegrationTestCase
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var FormTypeGroupExtension
     */
    protected $extension;

    public function setUp()
    {
        parent::setUp();

        $loader = new StubFilesystemLoader(array(
            __DIR__ . '/../../../vendor/symfony/twig-bridge/Symfony/Bridge/Twig/Resources/views/Form',
            __DIR__ . '/../../../Resources/views',
            __DIR__ . '/../../Resources/views', // templates used in tests
        ));

        $loader->addPath(__DIR__ . '/../../../Resources/views', 'FSiFormExtensions');

        $rendererEngine = new TwigRendererEngine(array(
            'form_div_layout.html.twig',
            'Form/form_div_layout.html.twig'
        ));
        $renderer = new TwigRenderer($rendererEngine, $this->getMock('Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface'));

        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');

        $container->expects($this->any())
            ->method('get')
            ->with($this->equalTo('templating.helper.assets'))
            ->will($this->returnValue(new AssetsHelper()));

        $twig = new \Twig_Environment($loader, array('strict_variables' => true));
        $twig->addGlobal('global', '');
        $twig->addExtension(new TranslationExtension(new StubTranslator()));
        $twig->addExtension(new AssetsExtension($container));
        $twig->addExtension(new FormExtension($renderer));
        $twig->addExtension(new TwigGroupExtension('/'));
        $this->twig = $twig;
    }

    public function getExtensions()
    {
        return array(
            new GroupExtension(),
            new CkeditorExtension()
        );
    }

    public function testFormRenderingWithCkeditor()
    {
        $form = $this->factory->create('form');

        $form->add('content', 'ckeditor');

        $html = $this->twig->render('form_with_ckeditor.html.twig', array(
            'form' => $form->createView()
        ));

        $this->assertSame($html, $this->getExpectedHtml('form_with_ckeditor.html'));
    }


    private function getExpectedHtml($filename)
    {
        $path = __DIR__ . '/../../Resources/views/' . $filename;
        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf('Invalid expected html file path "%s"', $path));
        }

        return file_get_contents($path);
    }
}
