<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\FixturesBundle\Controller;

use FSi\FixturesBundle\Form\Type\GalleryType;
use FSi\FixturesBundle\Model\Gallery;
use FSi\FixturesBundle\Model\GalleryPhoto;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class SortableCollectionController
{
    private FormFactoryInterface $formFactory;
    private Environment $twig;

    public function __construct(FormFactoryInterface $formFactory, Environment $twig)
    {
        $this->formFactory = $formFactory;
        $this->twig = $twig;
    }

    public function collectionAction(Request $request): Response
    {
        $gallery = $this->getModelGallery();
        $form = $this->formFactory->create(GalleryType::class, $gallery);
        $form->handleRequest($request);
        if (true === $form->isSubmitted() && true === $form->isValid()) {
        }

        return new Response(
            $this->twig->render('collection.html.twig', [
                'form' => $form->createView(),
                'gallery' => $gallery
            ])
        );
    }

    private function getModelGallery(): Gallery
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
