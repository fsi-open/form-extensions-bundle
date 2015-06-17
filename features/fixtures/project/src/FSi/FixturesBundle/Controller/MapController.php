<?php

namespace FSi\FixturesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    public function oneMapAction()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('map', 'fsi_map', array(
            'label' => 'Map field'
        ));

        $form = $formBuilder->getForm();

        return $this->render('FSiFixturesBundle:Map:map.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function multipleMapAction()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('map_one', 'fsi_map', array(
            'label' => 'Map field one'
        ));
        $formBuilder->add('map_two', 'fsi_map', array(
            'label' => 'Map field two'
        ));

        $form = $formBuilder->getForm();

        return $this->render('FSiFixturesBundle:Map:map.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
