<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSi\FixturesBundle\Form\Type;

use FSi\Bundle\FormExtensionsBundle\Form\Type\FSiMapType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

final class MultiMapType extends AbstractType
{
    /**
     * @param FormBuilderInterface<FormBuilderInterface> $builder
     * @param array<string, mixed> $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('map_one', FSiMapType::class, [
            'label' => 'Map field one'
        ]);

        $builder->add('map_two', FSiMapType::class, [
            'label' => 'Map field two'
        ]);
    }
}
