<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Behat\Element;

use SensioLabs\Behat\PageObjectExtension\PageObject\Element;

class Map extends Element
{
    /**
     * @var array<string, string>
     */
    protected $selector = ['css' => '.map-location'];

    /**
     * @param string|int|float $latitude
     * @param string|int|float $longitude
     * @return void
     */
    public function clickLocation($latitude, $longitude): void
    {
        $xpath = $this->getXpath();
        $script = <<<JS
var mapElement = document.evaluate("$xpath", document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
var evt = {
    stop: null,
    latLng: new google.maps.LatLng($latitude, $longitude)
};
google.maps.event.trigger($(mapElement).data('google-map').map, 'click', evt);
JS;

        $this->getDriver()->executeScript($script);
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        $script = "return $('.map-location').data('google-map').map.getCenter().lat();";
        return $this->getDriver()->evaluateScript($script);
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        $script = "return $('.map-location').data('google-map').map.getCenter().lng();";
        return $this->getDriver()->evaluateScript($script);
    }
}
