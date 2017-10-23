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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    public function oneMapAction()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('map', FSiMapType::class, [
            'label' => 'Map field'
        ]);

        $form = $formBuilder->getForm();

        return $this->render('@FSiFixtures/Map/map.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function multipleMapAction()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('map_one', FSiMapType::class, [
            'label' => 'Map field one'
        ]);
        $formBuilder->add('map_two', FSiMapType::class, [
            'label' => 'Map field two'
        ]);

        $form = $formBuilder->getForm();

        return $this->render('@FSiFixtures/Map/map.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
