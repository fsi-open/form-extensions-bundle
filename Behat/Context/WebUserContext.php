<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Behat\Context;

use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;

class WebUserContext extends PageObjectContext
{
    /**
     * @When /^I open "([^"]*)" page$/
     */
    public function iOpenPage($pageName)
    {
        $this->getPage($pageName)->open();
    }

    /**
     * @Then /^I should see form field with label "([^"]*)" that is CKEditor$/
     */
    public function iShouldSeeFormFieldWithLabelThatIsCKEditor($label)
    {
        expect($this->getElement('Form')->hasField($label))->toBe(true);
        expect($this->getElement('Form')->isCKEditor($label))->toBe(true);
    }

    /**
     * @Given /^"([^"]*)" page should have CKEditor included once from "([^"]*)" url$/
     */
    public function pageShouldHaveCkeditorIncludedOnceFromUrl($pageName, $scriptUrl)
    {
        expect($this->getPage($pageName)->getScriptIncludes($scriptUrl))->toHaveCount(1);
    }

    /**
     * @Given /^I move photo from position "([^"]*)" to position "([^"]*)"$/
     */
    public function iMovePhotoNumberToPosition($photoNumber, $newPosition)
    {
        $this->getElement('Form')->movePhoto($photoNumber, $newPosition);
    }

    /**
     * @Given /^submit the form$/
     */
    public function submitTheForm()
    {
        $this->getElement('Form')->submit();
    }

    /**
     * @Then /^I should see photo "([^"]*)" at position "([^"]*)"$/
     */
    public function iShouldSeePhotoNumberAtPosition($photo, $position)
    {
        expect($this->getPage('Sortable Collection Form')->getPhotoAtPosition($position)->getText())->toBe($photo);
    }
}
