<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\EventListener;

use FSi\Bundle\FormExtensionsBundle\Model\PositionableInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormConfigInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class SortableCollectionListenerSpec extends ObjectBehavior
{
    public function it_is_event_subscriber(): void
    {
        $this->beAnInstanceOf(EventSubscriberInterface::class);
    }

    public function it_listen_to_events()
    {
        $this->getSubscribedEvents()->shouldReturn([
            FormEvents::PRE_SUBMIT => 'rememberItemPosition',
            FormEvents::SUBMIT => 'persistItemPosition',
        ]);
    }

    public function it_does_nothing_when_no_data(
        FormEvent $formEvent1,
        FormEvent $formEvent2,
        FormInterface $form,
        PositionableInterface $item0,
        PositionableInterface $item1,
        PositionableInterface $item2
    ): void {
        $formEvent1->getForm()->willReturn($form);
        $formEvent1->getData()->willReturn(null);
        $this->rememberItemPosition($formEvent1);
        $formEvent2->getForm()->willReturn($form);
        $formEvent2->getData()->willReturn([$item0, $item1, $item2]);
        $item0->setPosition(Argument::any())->shouldNotBeCalled();
        $item1->setPosition(Argument::any())->shouldNotBeCalled();
        $item2->setPosition(Argument::any())->shouldNotBeCalled();
        $this->persistItemPosition($formEvent2);
    }

    public function it_does_nothing_when_empty_array(
        FormEvent $formEvent1,
        FormEvent $formEvent2,
        FormInterface $form,
        PositionableInterface $item0,
        PositionableInterface $item1,
        PositionableInterface $item2
    ): void {
        $formEvent1->getForm()->willReturn($form);
        $formEvent1->getData()->willReturn([]);
        $this->rememberItemPosition($formEvent1);
        $formEvent2->getForm()->willReturn($form);
        $formEvent2->getData()->willReturn([$item0, $item1, $item2]);
        $item0->setPosition(Argument::any())->shouldNotBeCalled();
        $item1->setPosition(Argument::any())->shouldNotBeCalled();
        $item2->setPosition(Argument::any())->shouldNotBeCalled();
        $this->persistItemPosition($formEvent2);
    }

    public function it_sets_positions(
        FormEvent $formEvent1,
        FormEvent $formEvent2,
        FormInterface $form,
        FormConfigInterface $formConfig,
        PositionableInterface $item0,
        PositionableInterface $item1,
        PositionableInterface $item2
    ): void {
        $formEvent1->getForm()->willReturn($form);
        $formEvent1->getData()->willReturn([0 => '', 2 => '', 1 => '']);
        $this->rememberItemPosition($formEvent1);
        $formEvent2->getForm()->willReturn($form);
        $formEvent2->getData()->willReturn([$item0, $item1, $item2]);
        $formConfig->hasOption('initial_position')->willReturn(false);
        $form->getConfig()->willReturn($formConfig);
        $item0->setPosition(1)->shouldBeCalled();
        $item1->setPosition(3)->shouldBeCalled();
        $item2->setPosition(2)->shouldBeCalled();
        $this->persistItemPosition($formEvent2);
    }

    public function is_set_positions_even_when_elements_are_removed(
        FormEvent $formEvent1,
        FormEvent $formEvent2,
        FormInterface $form,
        FormConfigInterface $formConfig,
        PositionableInterface $item0,
        PositionableInterface $item1,
        PositionableInterface $item2
    ): void {
        $formEvent1->getForm()->willReturn($form);
        $formEvent1->getData()->willReturn([0 => '', 1 => '', 2 => '']);
        $this->rememberItemPosition($formEvent1);
        $formEvent2->getForm()->willReturn($form);
        $formEvent2->getData()->willReturn([$item0, $item2]);
        $formConfig->hasOption('initial_position')->willReturn(false);
        $form->getConfig()->willReturn($formConfig);
        $item0->setPosition(1)->shouldBeCalled();
        $item1->setPosition(Argument::any())->shouldNotBeCalled();
        $item2->setPosition(2)->shouldBeCalled();
        $this->persistItemPosition($formEvent2);
    }

    public function it_sets_positions_for_two_collections_in_the_same_request(
        FormEvent $form1Event1,
        FormEvent $form1Event2,
        FormInterface $form1,
        FormConfigInterface $formConfig1,
        PositionableInterface $collection1Item0,
        PositionableInterface $collection1Item1,
        PositionableInterface $collection1Item2,
        FormEvent $form2Event1,
        FormEvent $form2Event2,
        FormInterface $form2,
        FormConfigInterface $formConfig2,
        PositionableInterface $collection2Item0,
        PositionableInterface $collection2Item1,
        PositionableInterface $collection2Item2
    ): void {
        $form1Event1->getForm()->willReturn($form1);
        $form1Event1->getData()->willReturn([0 => '', 2 => '', 1 => '']);
        $this->rememberItemPosition($form1Event1);

        $form2Event1->getForm()->willReturn($form2);
        $form2Event1->getData()->willReturn([1 => '', 0 => '', 2 => '']);
        $this->rememberItemPosition($form2Event1);

        $formConfig1->hasOption('initial_position')->willReturn(false);
        $form1->getConfig()->willReturn($formConfig1);
        $form1Event2->getForm()->willReturn($form1);
        $form1Event2->getData()->willReturn([$collection1Item0, $collection1Item1, $collection1Item2]);
        $collection1Item0->setPosition(1)->shouldBeCalled();
        $collection1Item1->setPosition(3)->shouldBeCalled();
        $collection1Item2->setPosition(2)->shouldBeCalled();
        $this->persistItemPosition($form1Event2);

        $formConfig2->hasOption('initial_position')->willReturn(true);
        $formConfig2->getOption('initial_position')->willReturn(0);
        $form2->getConfig()->willReturn($formConfig2);
        $form2Event2->getForm()->willReturn($form2);
        $form2Event2->getData()->willReturn([$collection2Item0, $collection2Item1, $collection2Item2]);
        $collection2Item0->setPosition(1)->shouldBeCalled();
        $collection2Item1->setPosition(0)->shouldBeCalled();
        $collection2Item2->setPosition(2)->shouldBeCalled();
        $this->persistItemPosition($form2Event2);
    }
}
