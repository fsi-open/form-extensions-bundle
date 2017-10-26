<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Twig;

use Twig_Extension;
use Twig_Extension_GlobalsInterface;

class FSiMapFormExtension extends Twig_Extension implements Twig_Extension_GlobalsInterface
{
    /**
     * @var string|null
     */
    private $apiKey;

    public function __construct(?string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getName()
    {
        return 'fsi_map_form';
    }

    public function getGlobals()
    {
        return ['fsi_map_api_key' => $this->apiKey];
    }
}
