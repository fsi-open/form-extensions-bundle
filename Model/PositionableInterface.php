<?php

namespace FSi\Bundle\FormExtensionsBundle\Model;

interface PositionableInterface
{
    /**
     * @param int $position
     */
    public function setPosition($position);

    /**
     * @return int
     */
    public function getPosition();
}
