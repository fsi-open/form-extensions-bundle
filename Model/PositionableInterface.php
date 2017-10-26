<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Model;

interface PositionableInterface
{
    /**
     * @param int $position
     */
    public function setPosition(int $position): void;

    /**
     * @return int
     */
    public function getPosition(): ?int;
}
