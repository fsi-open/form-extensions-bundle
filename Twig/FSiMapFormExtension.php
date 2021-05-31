<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class FSiMapFormExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var string|null
     */
    private $apiKey;

    public function __construct(?string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return array<string, mixed>
     */
    public function getGlobals(): array
    {
        return ['fsi_map_api_key' => $this->apiKey];
    }
}
