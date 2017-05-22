<?php

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

        return $this->render('FSiFixturesBundle:Map:map.html.twig', [
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

        return $this->render('FSiFixturesBundle:Map:map.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
