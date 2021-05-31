<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Behat\Page;

use Assert\Assertion;
use Behat\Mink\Element\NodeElement;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class SortableCollectionForm extends Page
{
    protected $path = '/sortable_collection';

    public function getPhotoAtPosition(int $position): NodeElement
    {
        $photo = $this->find('css', "ul li[data-position=\"{$position}\"]");
        Assertion::notNull($photo, "No photo at position \"{$position}\"");
        return $photo;
    }
}
