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
use Behat\Behat\Definition\Call\When;

final class WebUserContext extends AbstractContext
{
    /**
     * @When /^I open "([^"]*)" page$/
     */
    public function iOpenPage(string $pageName): void
    {
        $this->getPage($pageName)->open();
    }

    /**
     * @Given /^I move photo from position "([^"]*)" to position "([^"]*)"$/
     */
    public function iMovePhotoNumberToPosition(int $photoNumber, int $newPosition): void
    {
        $this->getElement('Form')->movePhoto($photoNumber, $newPosition);
    }

    /**
     * @Given /^submit the form$/
     */
    public function submitTheForm(): void
    {
        $this->getElement('Form')->submit();
    }

    /**
     * @Then /^I should see photo "([^"]*)" at position "([^"]*)"$/
     */
    public function iShouldSeePhotoNumberAtPosition(string $photo, int $position): void
    {
        Assertion::same(
            $this->getPage('Sortable Collection Form')->getPhotoAtPosition($position)->getText(),
            $photo
        );
    }
}
