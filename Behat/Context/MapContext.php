<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Behat\Context;

use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;
use Behat\Gherkin\Node\TableNode;

class MapContext extends PageObjectContext
{
    /**
     * @Then /^I should see form field with label "([^"]*)" that has Google map$/
     */
    public function iShouldSeeFormFieldWithLabelThatHasGoogleMap($label)
    {
        sleep(3);
        expect($this->getElement('Form')->isGoogleMap($label))->toBe(true);
    }

    /**
     * @Given /^Click on map at position: (.+)\/(.+)$/
     */
    public function clickOnMapAtPosition($latitude, $longitude)
    {
        sleep(3);
        $this->getElement('Map')->clickLocation($latitude, $longitude);
    }

    /**
     * @Then /^position fields shoud have values:$/
     */
    public function positionFieldOfShoudHaveValues(TableNode $table)
    {
        foreach ($table->getHash() as $row) {
            expect(substr($this->getElement('Form')->findField($row['Field'])->getValue(), 0, 6))->toBe($row['Value']);
        }
    }

    /**
     * @Given /^fill position fields:$/
     */
    public function fillPositionFields(TableNode $table)
    {
        sleep(3);
        foreach ($table->getHash() as $row) {
            $this->getElement('Form')->findField($row['Field'])->setValue($row['Value']);
        }
    }

    /**
     * @Then /^map position should be (.+)\/(.+)$/
     */
    public function mapPositionShouldBe($latitude, $longitude)
    {
        expect((string) $this->getElement('Map')->getLatitude())->toBe($latitude);
        expect((string) $this->getElement('Map')->getLongitude())->toBe($longitude);
    }
}
