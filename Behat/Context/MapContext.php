<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Behat\Context;

use Assert\Assertion;
use Behat\Gherkin\Node\TableNode;

final class MapContext extends AbstractContext
{
    /**
     * @Then /^I should see form field with label "([^"]*)" that has Google map$/
     */
    public function iShouldSeeFormFieldWithLabelThatHasGoogleMap(string $label): void
    {
        sleep(3);
        $this->startIfSessionNotStarted();
        Assertion::true($this->getElement('Form')->isGoogleMap($label));
    }

    /**
     * @Given /^Click on map at position: (.+)\/(.+)$/
     */
    public function clickOnMapAtPosition($latitude, $longitude): void
    {
        sleep(3);
        $this->getElement('Map')->clickLocation($latitude, $longitude);
    }

    /**
     * @Then /^position fields shoud have values:$/
     */
    public function positionFieldOfShoudHaveValues(TableNode $table): void
    {
        foreach ($table->getHash() as $row) {
            Assertion::same(
               substr($this->getElement('Form')->findField($row['Field'])->getValue(), 0, 6),
                $row['Value']
            );
        }
    }

    /**
     * @Given /^fill position fields:$/
     */
    public function fillPositionFields(TableNode $table): void
    {
        sleep(3);
        foreach ($table->getHash() as $row) {
            $this->getElement('Form')->findField($row['Field'])->setValue($row['Value']);
        }
    }

    /**
     * @Then /^map position should be (.+)\/(.+)$/
     */
    public function mapPositionShouldBe($latitude, $longitude): void
    {
        Assertion::same((string) $this->getElement('Map')->getLatitude(), $latitude);
        Assertion::same((string) $this->getElement('Map')->getLongitude(), $longitude);
    }
}
