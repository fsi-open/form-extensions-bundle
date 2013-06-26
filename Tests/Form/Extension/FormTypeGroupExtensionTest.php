<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Tests\Form\Extension;

use FSi\Bundle\FormExtensionsBundle\Tests\Fixtures\Form\Extension\GroupExtension;
use Symfony\Bridge\Twig\Extension\FormExtension as BaseFormExtension;
use FSi\Bundle\FormExtensionsBundle\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bridge\Twig\Tests\Extension\Fixtures\StubFilesystemLoader;
use Symfony\Bridge\Twig\Tests\Extension\Fixtures\StubTranslator;
use Symfony\Component\Form\Test\FormIntegrationTestCase;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class FormTypeGroupExtensionTest extends FormIntegrationTestCase
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

        $rendererEngine = new TwigRendererEngine(array(
            'form_div_layout.html.twig',
            'Form/form_div_layout.html.twig'
        ));
        $renderer = new TwigRenderer($rendererEngine, $this->getMock('Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface'));

        $twig = new \Twig_Environment($loader, array('strict_variables' => true));
        $twig->addGlobal('global', '');
        $twig->addExtension(new TranslationExtension(new StubTranslator()));
        $twig->addExtension(new BaseFormExtension($renderer));
        $twig->addExtension(new FormExtension('/'));
        $this->twig = $twig;
    }

    public function getExtensions()
    {
        return array(
            new GroupExtension()
        );
    }

    public function testFormRenderingWithGroups()
    {
        $form = $this->factory->create('form', null, array(
            'groups' => array(
                'basic' => 'group.basic.name',
                'content' => 'group.extra.name'
            )
        ));

        $form->add('email', 'email');

        $form->add('text', 'text', array(
            'group' => 'basic'
        ));

        $form->add('content', 'textarea', array(
            'group' => 'content'
        ));

        $form->add('password', 'repeated', array(
            'type' => 'password',
        ));

        $html = $this->twig->render('form_with_groups.html.twig', array(
            'form' => $form->createView()
        ));

        $this->assertSame($html, $this->getExpectedHtml('form_with_groups.html'));
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