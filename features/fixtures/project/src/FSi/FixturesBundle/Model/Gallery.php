<?php

namespace FSi\FixturesBundle\Model;

class Gallery
{
    /**
     * @var GalleryPhoto[]
     */
    private $photos;

    public function __construct()
    {
        $this->photos = array();
    }

    /**
     * @param GalleryPhoto $photo
     */
    public function addPhoto(GalleryPhoto $photo)
    {
        if (!in_array($photo, $this->photos, true)) {
            $photo->setGallery($this);
            $this->photos[] = $photo;
        }
    }

    /**
     * @param GalleryPhoto $photo
     */
    public function removePhoto(GalleryPhoto $photo)
    {
        $this->photos = array_filter($this->photos, function ($item) use ($photo) {return $item !== $photo;});
    }

    /**
     * @return GalleryPhoto[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
