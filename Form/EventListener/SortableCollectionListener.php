<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Form\EventListener;

use FSi\Bundle\FormExtensionsBundle\Model\PositionableInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SortableCollectionListener implements EventSubscriberInterface
{
    /**
     * @var array<string, array<string>>|null
     */
    private ?array $itemOrder = [];

    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'rememberItemPosition',
            FormEvents::SUBMIT => 'persistItemPosition',
        ];
    }

    public function rememberItemPosition(FormEvent $event): void
    {
        $formId = $this->getEventFormId($event);
        $this->itemOrder[$formId] = $this->getEventDataKeys($event);
    }

    public function persistItemPosition(FormEvent $event): void
    {
        $itemOrder = $this->getRememberedItemOrder($event);
        if (null === $itemOrder || 0 === count($itemOrder)) {
            return;
        }

        $formConfig = $event->getForm()->getConfig();
        $position = $formConfig->hasOption('initial_position') ? $formConfig->getOption('initial_position') : 1;
        $data = $event->getData();
        foreach ($itemOrder as $index) {
            if (!isset($data[$index])) {
                continue;
            }

            $item = $data[$index];
            if ($item instanceof PositionableInterface) {
                $item->setPosition($position++);
            }
        }
    }

    /**
     * @param FormEvent $event
     * @return array<string>|null
     */
    private function getEventDataKeys(FormEvent $event): ?array
    {
        if (false === is_array($event->getData())) {
            return null;
        }

        return array_keys($event->getData());
    }

    /**
     * @param FormEvent $event
     * @return array<string>|null
     */
    private function getRememberedItemOrder(FormEvent $event): ?array
    {
        return $this->itemOrder[$this->getEventFormId($event)] ?? null;
    }

    private function getEventFormId(FormEvent $event): string
    {
        return spl_object_hash($event->getForm());
    }
}
