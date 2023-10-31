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
use FSi\Bundle\FormExtensionsBundle\Behat\Element\Form;
use FSi\Bundle\FormExtensionsBundle\Behat\Page\MultipleMapForm;
use FSi\Bundle\FormExtensionsBundle\Behat\Page\OneMapForm;
use FSi\Bundle\FormExtensionsBundle\Behat\Page\SortableCollectionForm;
use RuntimeException;

final class WebUserContext extends AbstractContext
{
    /**
     * @When /^I open "([^"]*)" page$/
     */
    public function iOpenPage(string $pageName): void
    {
        switch ($pageName) {
            case 'One Map Form':
                $className = OneMapForm::class;
                break;
            case 'Multiple Map Form':
                $className = MultipleMapForm::class;
                break;
            case 'Sortable Collection Form':
                $className = SortableCollectionForm::class;
                break;
            default:
                throw new RuntimeException("Unknown page \"{$pageName}\".");
        }

        $this->getPage($className)->open();
    }

    /**
     * @Given /^I move photo from position "([^"]*)" to position "([^"]*)"$/
     */
    public function iMovePhotoNumberToPosition(int $photoNumber, int $newPosition): void
    {
        $this->getFormElement()->movePhoto($photoNumber, $newPosition);
    }

    /**
     * @Given /^submit the form$/
     */
    public function submitTheForm(): void
    {
        $this->getFormElement()->submit();
    }

    /**
     * @Then /^I should see photo "([^"]*)" at position "([^"]*)"$/
     */
    public function iShouldSeePhotoNumberAtPosition(string $photo, int $position): void
    {
        /** @var SortableCollectionForm $page */
        $page = $this->getPage(SortableCollectionForm::class);
        Assertion::same($page->getPhotoAtPosition($position)->getText(), $photo);
    }

    private function getFormElement(): Form
    {
        /** @var Form $formElement */
        $formElement = $this->getElement(Form::class);
        return $formElement;
    }
}
