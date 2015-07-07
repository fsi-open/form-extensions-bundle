<?php

namespace FSi\Bundle\FormExtensionsBundle\Behat\Context\Page\Element;

use SensioLabs\Behat\PageObjectExtension\PageObject\Element;

class Map extends Element
{
    protected $selector = array('css' => '.map-location');

    public function clickLocation($latitude, $longitude)
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

    public function getLatitude()
    {
        $script = "return $('.map-location').data('google-map').map.getCenter().lat();";
        return $this->getDriver()->evaluateScript($script);
    }

    public function getLongitude()
    {
        $script = "return $('.map-location').data('google-map').map.getCenter().lng();";
        return $this->getDriver()->evaluateScript($script);
    }
}
