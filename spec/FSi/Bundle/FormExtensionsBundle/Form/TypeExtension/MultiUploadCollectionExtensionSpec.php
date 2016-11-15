<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\Form\TypeExtension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MultiUploadCollectionExtensionSpec extends ObjectBehavior
{
    public function it_extends_collection()
    {
        $this->getExtendedType()->shouldReturn(CollectionType::class);
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function it_set_options($resolver)
    {
        $resolver->setDefaults(array('multi_upload_field' => null))->shouldBeCalled();
        $resolver->setAllowedTypes('multi_upload_field', array('null', 'string'))->shouldBeCalled();

        $this->configureOptions($resolver);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     */
    public function it_add_listener_if_options_set($builder)
    {
        $builder->addEventSubscriber(Argument::type('FSi\Bundle\FormExtensionsBundle\Form\EventListener\MultiUploadCollectionListener'))
            ->shouldBeCalled();

        $this->buildForm($builder, array('multi_upload_field' => 'file'));
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     */
    public function it_does_nothing_field_option_is_null($builder)
    {
        $builder->addEventSubscriber(Argument::type('FSi\Bundle\FormExtensionsBundle\Form\EventListener\MultiUploadCollectionListener'))
            ->shouldNotBeCalled();

        $this->buildForm($builder, array());
    }
}
