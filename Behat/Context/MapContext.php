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
use Behat\Behat\Definition\Call\Given;
use Behat\Behat\Definition\Call\Then;
use Behat\Gherkin\Node\TableNode;
use FSi\Bundle\FormExtensionsBundle\Behat\Element\Form;
use FSi\Bundle\FormExtensionsBundle\Behat\Element\Map;

use function sleep;
use function substr;

final class MapContext extends AbstractContext
{
    /**
     * @Then /^I should see form field with label "([^"]*)" that has Google map$/
     */
    public function iShouldSeeFormFieldWithLabelThatHasGoogleMap(string $label): void
    {
        sleep(3);
        $this->startIfSessionNotStarted();
        Assertion::true($this->getFormElement()->isGoogleMap($label));
    }

    /**
     * @Given /^Click on map at position: (.+)\/(.+)$/
     *
     * @param int|float|string $latitude
     * @param int|float|string $longitude
     * @return void
     */
    public function clickOnMapAtPosition($latitude, $longitude): void
    {
        sleep(3);
        $this->getMapElement()->clickLocation($latitude, $longitude);
    }

    /**
     * @Then /^position fields shoud have values:$/
     *
     * @param TableNode<array<string, mixed>> $table
     * @return void
     */
    public function positionFieldOfShoudHaveValues(TableNode $table): void
    {
        $formElement = $this->getFormElement();
        foreach ($table->getHash() as $row) {
            $label = $row['Field'];
            $field = $formElement->findField($label);
            Assertion::notNull($field, "No field \"{$label}\"");

            /** @var string $value */
            $value = $field->getValue();
            Assertion::same(substr($value, 0, 6), $row['Value']);
        }
    }

    /**
     * @Given /^fill position fields:$/
     *
     * @param TableNode<array<string, mixed>> $table
     * @return void
     */
    public function fillPositionFields(TableNode $table): void
    {
        sleep(3);

        $formElement = $this->getFormElement();
        foreach ($table->getHash() as $row) {
            $label = $row['Field'];
            $field = $formElement->findField($label);
            Assertion::notNull($field, "No field \"{$label}\"");
            $field->setValue($row['Value']);
        }
    }

    /**
     * @Then /^map position should be (.+)\/(.+)$/
     *
     * @param string|int|float $latitude
     * @param string|int|float $longitude
     * @return void
     */
    public function mapPositionShouldBe($latitude, $longitude): void
    {
        $mapElement = $this->getMapElement();
        Assertion::same((string) $mapElement->getLatitude(), $latitude);
        Assertion::same((string) $mapElement->getLongitude(), $longitude);
    }

    private function getFormElement(): Form
    {
        /** @var Form $formElement */
        $formElement = $this->getElement('Form');
        return $formElement;
    }

    private function getMapElement(): Map
    {
        /** @var Map $mapElement */
        $mapElement = $this->getElement('Map');
        return $mapElement;
    }
}
