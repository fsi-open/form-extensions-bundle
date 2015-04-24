<?php

namespace FSi\Bundle\FormExtensionsBundle\Form\TypeExtension;

use FSi\Bundle\FormExtensionsBundle\Form\EventListener\SortableCollectionListener;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class SortableCollectionExtension extends AbstractTypeExtension
{
    /**
     * @var SortableCollectionListener
     */
    private $sortableListener;

    /**
     * @param SortableCollectionListener $sortableListener
     */
    function __construct(SortableCollectionListener $sortableListener)
    {
        $this->sortableListener = $sortableListener;
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType()
    {
        return 'collection';
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber($this->sortableListener);
    }
}
