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

    public function movePhoto($photoNumber, $newPosition)
    {
        $this->getDriver()->executeScript(sprintf("
var photo = document.getElementById('gallery_photos_%s');
var parent = photo.parentNode;
photo.remove();
var insertBefore = document.getElementById('gallery_photos_%s');
parent.insertBefore(photo, insertBefore)",
            $photoNumber - 1, $newPosition - 1));
    }

    public function getGoogleMapWrapper($label)
    {
        return $this->find('xpath', sprintf('//label[text()="%s"]/parent::*/descendant::*[contains(concat(" ", normalize-space(@class), " "), " map-location ")]', $label));
    }

    public function isGoogleMap($fieldSelector)
    {
        if (!$this->getDriver() instanceof Selenium2Driver) {
            throw new UnexpectedPageException("isGoogleMap method require Selenium2 Driver");
        }

        $wrapper = $this->getGoogleMapWrapper($fieldSelector);
        expect($wrapper)->notToBe(null);

        return $wrapper->has('css', '.gm-style');
    }
}
