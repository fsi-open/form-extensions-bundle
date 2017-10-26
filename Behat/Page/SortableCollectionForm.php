<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Behat\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class SortableCollectionForm extends Page
{
    protected $path = '/sortable_collection';

    public function getPhotoAtPosition(int $position)
    {
        return $this->find('css', sprintf('ul li[data-position="%d"]', $position));
    }
}
