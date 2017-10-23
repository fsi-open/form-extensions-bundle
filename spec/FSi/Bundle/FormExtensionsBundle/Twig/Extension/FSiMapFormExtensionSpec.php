<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\FSi\Bundle\FormExtensionsBundle\Twig\Extension;

use PhpSpec\ObjectBehavior;

class FSimapFormExtensionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('abc123');
    }

    function it_is_twig_extension()
    {
        $this->shouldHaveType('Twig_Extension');
    }

    function it_have_name()
    {
        return $this->getName()->shouldReturn('fsi_map_form');
    }

    function it_have_globals()
    {
        $this->getGLobals()->shouldReturn(['fsi_map_api_key' => 'abc123']);
    }
}
