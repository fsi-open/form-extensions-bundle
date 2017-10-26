<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\EventListener;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MultiUploadCollectionListenerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('file');
    }

    function it_handles_pre_submit_with_priority_higher_than_default()
    {
        $this->getSubscribedEvents()->shouldReturn([
            FormEvents::PRE_SUBMIT => ['preSubmit', 1]
        ]);
    }

    function it_does_nothing_if_data_is_not_an_array(FormEvent $formEvent)
    {
        $formEvent->getData()->willReturn('string');

        $formEvent->setData(Argument::any())->shouldNotBeCalled();

        $this->preSubmit($formEvent);
    }

    function it_unwraps_multiple_files_into_new_collection_items(FormEvent $formEvent)
    {
        $formEvent->getData()->willReturn([
            0 => [
                'another_field' => null,
                'file' => null
            ],
            1 => [
                'another_field' => null,
                'file' => [
                    'first_file',
                    'second_file'
                ]
            ],
            2 => [
                'another_field' => null,
                'file' => 'single_file'
            ]
        ]);

        $formEvent->setData([
            0 => [
                'another_field' => null,
                'file' => null
            ],
            1 => [
                'another_field' => null,
                'file' => 'first_file'
            ],
            2 => [
                'another_field' => null,
                'file' => 'single_file'
            ],
            3 => [
                'file' => 'second_file'
            ]
        ])->shouldBeCalled();

        $this->preSubmit($formEvent);
    }
}
