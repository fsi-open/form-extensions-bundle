<?php

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
        $this->getSubscribedEvents()->shouldReturn(array(
            FormEvents::PRE_SUBMIT => array('preSubmit', 1)
        ));
    }

    function it_does_nothing_if_data_is_not_an_array(FormEvent $formEvent)
    {
        $formEvent->getData()->willReturn('string');

        $formEvent->setData(Argument::any())->shouldNotBeCalled();

        $this->preSubmit($formEvent);
    }

    function it_unwraps_multiple_files_into_new_collection_items(FormEvent $formEvent)
    {
        $formEvent->getData()->willReturn(array(
            0 => array(
                'another_field' => null,
                'file' => null
            ),
            1 => array(
                'another_field' => null,
                'file' => array(
                    'first_file',
                    'second_file'
                )
            ),
            2 => array(
                'another_field' => null,
                'file' => 'single_file'
            )
        ));

        $formEvent->setData(array(
            0 => array(
                'another_field' => null,
                'file' => null
            ),
            1 => array(
                'another_field' => null,
                'file' => 'first_file'
            ),
            2 => array(
                'another_field' => null,
                'file' => 'single_file'
            ),
            3 => array(
                'file' => 'second_file'
            )
        ))->shouldBeCalled();

        $this->preSubmit($formEvent);
    }
}
