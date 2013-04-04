<?php

/**
 * (c) Fabryka Stron Internetowych sp. z o.o <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\FormExtensionsBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class FileTypeVichUploaderExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array(
            'file_name_path',
        ));

        $resolver->setDefaults(array(
            'preview_attr' => array(),
        ));

        $resolver->addAllowedTypes(array(
            'preview_attr' => 'array',
            'file_name_path' => 'string',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $parent = $form->getParent();
        while (isset($parent)) {
            $entity = $parent->getData();
            $parent = $parent->getParent();
        }

        $accessor = PropertyAccess::getPropertyAccessor();
        $file = $accessor->getValue($entity, $form->getPropertyPath());
        $fileName = $accessor->getValue($entity, $options['file_name_path']);
        if (isset($file) && !$file instanceof File) {
            $file = new File($file);
        }

        $view->vars = array_merge(
            $view->vars,
            array(
                'file' => $file,
                'entity' => $entity,
                'file_name' => $fileName,
                'file_property_path' => $form->getPropertyPath(),
                'preview_attr' => $options['preview_attr'],
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'file';
    }
}