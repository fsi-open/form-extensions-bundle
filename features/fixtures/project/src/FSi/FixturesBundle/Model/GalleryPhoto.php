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
    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     */
    public function setGallery(Gallery $gallery): void
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
    public function setFile($file): void
    {
        $this->file = $file;
    }

    /**
     * @return int
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

}
