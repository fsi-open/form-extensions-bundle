<?php

namespace FSi\Bundle\FormExtensionsBundle\Form\EventListener;

use FSi\Bundle\FormExtensionsBundle\Model\PositionableInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SortableCollectionListener implements EventSubscriberInterface
{
    /**
     * @var array
     */
    private $itemOrder = array();

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SUBMIT => 'rememberItemPosition',
            FormEvents::SUBMIT => 'persistItemPosition',
        );
    }

    /**
     * @param FormEvent $event
     */
    public function rememberItemPosition(FormEvent $event)
    {
        $formId = $this->getEventFormId($event);
        $this->itemOrder[$formId] = array_keys($event->getData());
    }

    /**
     * @param FormEvent $event
     */
    public function persistItemPosition(FormEvent $event)
    {
        if (!($itemOrder = $this->getRememberedItemOrder($event))) {
            return;
        }

        $position = 1;
        $data = $event->getData();
        foreach ($itemOrder as $index) {
            $item = $data[$index];
            if ($item instanceof PositionableInterface) {
                $item->setPosition($position++);
            }
        }
    }

    /**
     * @param \Symfony\Component\Form\FormEvent $event
     * @return array|null
     */
    private function getRememberedItemOrder(FormEvent $event)
    {
        $formId = $this->getEventFormId($event);

        if (isset($this->itemOrder[$formId])) {
            return $this->itemOrder[$formId];
        } else {
            return null;
        }
    }

    /**
     * @param \Symfony\Component\Form\FormEvent $event
     * @return string
     */
    private function getEventFormId(FormEvent $event)
    {
        return spl_object_hash($event->getForm());
    }
}
