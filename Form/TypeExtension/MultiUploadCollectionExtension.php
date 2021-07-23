<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Form\TypeExtension;

use FSi\Bundle\FormExtensionsBundle\Form\EventListener\MultiUploadCollectionListener;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MultiUploadCollectionExtension extends AbstractTypeExtension
{
    /**
     * @return iterable<string>
     */
    public static function getExtendedTypes(): iterable
    {
        return [CollectionType::class];
    }

    public function getExtendedType(): string
    {
        return CollectionType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('multi_upload_field', null);
        $resolver->setAllowedTypes('multi_upload_field', ['null', 'string']);
    }

    /**
     * @param FormBuilderInterface<FormBuilderInterface> $builder
     * @param array<string, mixed> $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if (null !== $options['multi_upload_field'] && '' !== $options['multi_upload_field']) {
            $builder->addEventSubscriber(new MultiUploadCollectionListener($options['multi_upload_field']));
        }
    }
}
