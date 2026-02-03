<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MultiUploadCollectionListener implements EventSubscriberInterface
{
    private string $fileField;

    public function __construct(string $fileField)
    {
        $this->fileField = $fileField;
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => ['preSubmit', 1]
        ];
    }

    public function preSubmit(FormEvent $formEvent): void
    {
        $data = $formEvent->getData();
        if (false === is_array($data)) {
            return;
        }

        $newData = $data;
        foreach ($data as $key => $element) {
            if (false === array_key_exists($this->fileField, $element)) {
                continue;
            }

            $files = $element[$this->fileField];
            if (false === is_array($files)) {
                $files = [$files];
            }

            $filesCount = count($files);
            if (0 === $filesCount) {
                $newData[$key][$this->fileField] = [null];
                continue;
            }

            $newData[$key][$this->fileField] = [reset($files)];
            for ($i = 1; $i < $filesCount; $i++) {
                $newData[] = [
                    $this->fileField => [$files[$i]]
                ];
            }
        }

        $formEvent->setData($newData);
    }
}
