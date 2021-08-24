<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\FixturesBundle\Controller;

use FSi\FixturesBundle\Form\Type\MultiMapType;
use FSi\FixturesBundle\Form\Type\SingleMapType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class MapController
{
    private FormFactoryInterface $formFactory;
    private Environment $twig;

    public function __construct(FormFactoryInterface $formFactory, Environment $twig)
    {
        $this->formFactory = $formFactory;
        $this->twig = $twig;
    }

    public function oneMapAction(): Response
    {
        return new Response(
            $this->twig->render('map.html.twig', [
                'form' => $this->formFactory->create(SingleMapType::class)->createView()
            ])
        );
    }

    public function multipleMapAction(): Response
    {
        return new Response(
            $this->twig->render('map.html.twig', [
                'form' => $this->formFactory->create(MultiMapType::class)->createView()
            ])
        );
    }
}
