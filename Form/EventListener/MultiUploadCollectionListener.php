<?php

namespace FSi\Bundle\FormExtensionsBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MultiUploadCollectionListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $fileField;

    /**
     * @param string $fileField
     */
    public function __construct($fileField)
    {
        $this->fileField = $fileField;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => ['preSubmit', 1]
        ];
    }

    /**
     * @param FormEvent $formEvent
     */
    public function preSubmit(FormEvent $formEvent)
    {
        $data = $formEvent->getData();
        if (!is_array($data)) {
            return;
        }

        $newData = $data;
        foreach ($data as $key => $element) {
            $files = $element[$this->fileField];
            if (!is_array($files)) {
                $files = [$files];
            }
            $newData[$key][$this->fileField] = reset($files);
            for ($i = 1; $i < count($files); $i++) {
                $newData[] = [
                    $this->fileField => $files[$i]
                ];
            }
        }

        $formEvent->setData($newData);
    }
}
