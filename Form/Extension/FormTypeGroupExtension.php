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

/**
 * @author Norbert Orzechowicz <norbert@fsi.pl>
 */
class FormTypeGroupExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'groups' => array(),
            'group' => null
        ));

        $resolver->setAllowedTypes(array(
            'groups' => 'array',
            'group' => array('string', 'null')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $groups = array();
        foreach ($options['groups'] as $groupKey => $groupName) {
            $groups[$groupKey] = array();
        }

        foreach ($form->all() as $element) {
            /* @var $element FormInterface */
            $group = $element->getConfig()->hasOption('group')
                ? $element->getConfig()->getOption('group')
                : null;

            $group = array_key_exists($group, $groups) ? $group : null;

            if (!is_null($group)) {
                $groups[$group][] = $element->getName();
            }
        }

        $view->vars['groups_names'] = $options['groups'];
        $view->vars['groups'] = $groups;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'form';
    }
}