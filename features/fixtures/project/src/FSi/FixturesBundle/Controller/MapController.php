<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\FixturesBundle\Controller;

use FSi\Bundle\FormExtensionsBundle\Form\Type\FSiMapType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class MapController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(FormFactoryInterface $formFactory, Environment $twig)
    {
        $this->formFactory = $formFactory;
        $this->twig = $twig;
    }

    public function oneMapAction(): Response
    {
        $form = $this->formFactory->create(FormType::class);
        $form->add('map', FSiMapType::class, ['label' => 'Map field']);

        return new Response(
            $this->twig->render('@FSiFixtures/Map/map.html.twig', ['form' => $form->createView()])
        );
    }

    public function multipleMapAction(): Response
    {
        $form = $this->formFactory->create(FormType::class);
        $form->add('map_one', FSiMapType::class, [
            'label' => 'Map field one'
        ]);
        $form->add('map_two', FSiMapType::class, [
            'label' => 'Map field two'
        ]);

        return new Response(
            $this->twig->render('@FSiFixtures/Map/map.html.twig', ['form' => $form->createView()])
        );
    }
}
