<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Behat\Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class OneCKEditorForm extends Page
{
    protected $path = '/one_ckeditor';

    public function getScriptIncludes(string $scriptUrl)
    {
        return $this->findAll('css', sprintf('script[src="%s"]', $scriptUrl));
    }
}
