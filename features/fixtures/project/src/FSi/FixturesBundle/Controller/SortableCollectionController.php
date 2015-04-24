<?php

namespace FSi\FixturesBundle\Controller;

use FSi\FixturesBundle\Form\Type\GalleryType;
use FSi\FixturesBundle\Model\Gallery;
use FSi\FixturesBundle\Model\GalleryPhoto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SortableCollectionController extends Controller
{
    public function collectionAction(Request $request)
    {
        $gallery = $this->getModelGallery();

        $form = $this->createForm(new GalleryType(), $gallery);
        $form->handleRequest($request);
        if ($form->isValid()) {
        }

        $view = $form->createView();
        return $this->render('FSiFixturesBundle:SortableCollection:collection.html.twig', array(
            'form' => $view,
            'gallery' => $gallery
        ));
    }

    /**
     * @return \FSi\FixturesBundle\Model\Gallery
     */
    private function getModelGallery()
    {
        $gallery = new Gallery();
        $photo1 = new GalleryPhoto();
        $photo1->setFile('photo1');
        $photo1->setPosition(1);
        $photo2 = new GalleryPhoto();
        $photo2->setPosition(2);
        $photo2->setFile('photo2');
        $photo3 = new GalleryPhoto();
        $photo3->setPosition(3);
        $photo3->setFile('photo3');
        $gallery->addPhoto($photo1);
        $gallery->addPhoto($photo2);
        $gallery->addPhoto($photo3);

        return $gallery;
    }
}
