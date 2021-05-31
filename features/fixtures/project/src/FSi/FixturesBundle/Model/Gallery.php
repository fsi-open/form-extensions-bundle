<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\FixturesBundle\Model;

use function in_array;

class Gallery
{
    /**
     * @var GalleryPhoto[]
     */
    private $photos = [];

    public function addPhoto(GalleryPhoto $photo): void
    {
        if (true === in_array($photo, $this->photos, true)) {
            return;
        }

        $photo->setGallery($this);
        $this->photos[] = $photo;
    }

    public function removePhoto(GalleryPhoto $photo): void
    {
        $this->photos = array_filter(
            $this->photos,
            function (GalleryPhoto $item) use ($photo): bool {
                return $item !== $photo;
            }
        );
    }

    /**
     * @return array<GalleryPhoto>
     */
    public function getPhotos(): array
    {
        return $this->photos;
    }
}
