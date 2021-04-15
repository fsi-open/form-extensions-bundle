<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\FixturesBundle\Form\Type;

use FSi\FixturesBundle\Model\Gallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    /**
     * @param FormBuilderInterface<FormBuilderInterface> $builder
     * @param array<string, mixed> $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('photos', CollectionType::class, [
            'entry_type' => GalleryPhotoType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ]);

        $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Gallery::class);
    }
}
