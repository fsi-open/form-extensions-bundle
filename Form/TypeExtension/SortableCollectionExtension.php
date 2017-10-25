<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Form\TypeExtension;

use FSi\Bundle\FormExtensionsBundle\Form\EventListener\SortableCollectionListener;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class SortableCollectionExtension extends AbstractTypeExtension
{
    /**
     * @var SortableCollectionListener
     */
    private $sortableListener;

    public function __construct(SortableCollectionListener $sortableListener)
    {
        $this->sortableListener = $sortableListener;
    }

    public function getExtendedType()
    {
        return CollectionType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber($this->sortableListener);
    }
}
