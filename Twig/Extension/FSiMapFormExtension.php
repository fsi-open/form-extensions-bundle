<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Twig\Extension;

use Twig_Extension;
use Twig_Extension_GlobalsInterface;

class FSiMapFormExtension extends Twig_Extension implements Twig_Extension_GlobalsInterface
{
    /**
     * @var string
     */
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fsi_map_form';
    }

    public function getGlobals()
    {
        return ['fsi_map_api_key' => $this->apiKey];
    }
}
