<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Tests\Fixtures\Form\Extension;

use FSi\Bundle\FormExtensionsBundle\Form\Type\CkeditorType;
use Symfony\Component\Form\AbstractExtension;

class CkeditorExtension extends  AbstractExtension
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        $this->options = $options;
    }

    /**
     * @return CkeditorType|\Symfony\Component\Form\FormTypeInterface[]
     */
    protected function loadTypes()
    {
        return array(
            new CkeditorType($this->options)
        );
    }
}