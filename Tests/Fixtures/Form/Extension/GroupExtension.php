<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Tests\Fixtures\Form\Extension;

use FSi\Bundle\FormExtensionsBundle\Form\Extension\FormTypeGroupExtension;
use Symfony\Component\Form\AbstractExtension;

class GroupExtension extends  AbstractExtension
{
    protected function loadTypeExtensions()
    {
        return array(
            new FormTypeGroupExtension()
        );
    }
}