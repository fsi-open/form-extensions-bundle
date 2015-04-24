<?php

namespace FSi\FixturesBundle\Model;

use FSi\Bundle\FormExtensionsBundle\Model\PositionableInterface;

class GalleryPhoto implements PositionableInterface
{
    /**
     * @var Gallery
     */
    private $gallery;

    /**
     * @var string
     */
    private $file;

    /**
     * @var int
     */
    private $position;

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     */
    public function setGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

}
