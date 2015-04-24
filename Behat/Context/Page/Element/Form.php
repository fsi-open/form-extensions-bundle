<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Behat\Context\Page\Element;

use Behat\Mink\Driver\Selenium2Driver;
use SensioLabs\Behat\PageObjectExtension\PageObject\Element;
use SensioLabs\Behat\PageObjectExtension\PageObject\Exception\UnexpectedPageException;

class Form extends Element
{
    protected $selector = array('css' => 'form');

    public function isCKEditor($fieldSelector)
    {
        if (!$this->getSession()->getDriver() instanceof Selenium2Driver) {
            throw new UnexpectedPageException("isCKEditor method require Selenium2 Driver");
        }

        $field = $this->findField($fieldSelector);
        $editorId = sprintf('cke_%s', $field->getAttribute('id'));
        return $this->has('css', sprintf('div#%s', $editorId));
    }

    public function movePhoto($photoNumber, $newPosition)
    {
        $this->getSession()->executeScript(sprintf("
var photo = document.getElementById('gallery_photos_%s');
var parent = photo.parentNode;
photo.remove();
var insertBefore = document.getElementById('gallery_photos_%s');
parent.insertBefore(photo, insertBefore)",
            $photoNumber - 1, $newPosition - 1));
    }
}
