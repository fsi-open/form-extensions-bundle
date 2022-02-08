<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\TypeExtension;

use FSi\Bundle\FormExtensionsBundle\Form\EventListener\MultiUploadCollectionListener;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MultiUploadCollectionExtensionSpec extends ObjectBehavior
{
    public function it_extends_collection(): void
    {
        $this->getExtendedType()->shouldReturn(CollectionType::class);
    }

    public function it_sets_options(OptionsResolver $resolver): void
    {
        $resolver->setDefault('multi_upload_field', null)->shouldBeCalled();
        $resolver->setAllowedTypes('multi_upload_field', ['null', 'string'])->shouldBeCalled();

        $this->configureOptions($resolver);
    }

    public function it_adds_listener_if_options_set(FormBuilderInterface $builder): void
    {
        $builder->addEventSubscriber(Argument::type(MultiUploadCollectionListener::class))->shouldBeCalled();

        $this->buildForm($builder, ['multi_upload_field' => 'file']);
    }

    public function it_does_nothing_field_option_is_null(FormBuilderInterface $builder): void
    {
        $builder->addEventSubscriber(Argument::type(MultiUploadCollectionListener::class))->shouldNotBeCalled();

        $this->buildForm($builder, ['multi_upload_field' => null]);
    }
}
