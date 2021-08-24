<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\FixturesBundle\Model;

use FSi\Bundle\FormExtensionsBundle\Model\PositionableInterface;

class GalleryPhoto implements PositionableInterface
{
    private ?Gallery $gallery;
    private ?string $file;
    private ?int $position;

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    public function setGallery(Gallery $gallery): void
    {
        $this->gallery = $gallery;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): void
    {
        $this->file = $file;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }
}
