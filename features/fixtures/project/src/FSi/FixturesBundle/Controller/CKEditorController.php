<?php

namespace FSi\FixturesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CKEditorController extends Controller
{
    public function oneCKEditorAction()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('content', 'fsi_ckeditor', array(
            'label' => 'CKEditor field'
        ));

        $form = $formBuilder->getForm();

        return $this->render('FSiFixturesBundle:CKEditor:oneCKEditor.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function multipleCKEditorAction()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('content_one', 'fsi_ckeditor', array(
            'label' => 'CKEditor field one'
        ));
        $formBuilder->add('content_two', 'fsi_ckeditor', array(
            'label' => 'CKEditor field two'
        ));

        $form = $formBuilder->getForm();

        return $this->render('FSiFixturesBundle:CKEditor:oneCKEditor.html.twig', array(
            'form' => $form->createView()
        ));
    }
}