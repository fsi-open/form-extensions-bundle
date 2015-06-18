<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Twig\Extension;

class FSiMapFormExtension extends \Twig_Extension
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
        return [
            'fsi_map_api_key' => $this->apiKey,
        ];
    }
}
