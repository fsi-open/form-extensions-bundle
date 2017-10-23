<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\FixturesBundle\Model;

class Gallery
{
    /**
     * @var GalleryPhoto[]
     */
    private $photos = [];

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
