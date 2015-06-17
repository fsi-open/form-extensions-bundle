<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Behat\Context;

use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;

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
}
