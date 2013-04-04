#Symfony2 form grouping extension#

This extension provides fieldsets to symfony form component.

##1. Usage##

```php
// src/FSi/DemoBundle/Form/Type/NewsType.php

namespace FSi\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'label' => 'Title',
            'label_attr' => array('class' => 'control-label'),
            'group' => 'news.form.group.basic'
        ));

        $builder->add('categories', 'entity', array(
            'label' => 'news.form.category.label',
            'label_attr' => array('class' => 'control-label'),
            'class' => 'FSiDemoBundle:Category',
            'property' => 'title',
            'multiple' => true,
            'expanded' => false,
            'empty_value' => 'news.form.category.empty_value',
            'required' => false,
            'group' => 'news.form.group.basic'
        ));

        $builder->add('author', 'entity', array(
            'class' => 'FSiDemoBundle:User',
            'empty_value' => ' -- ',
            'translation_domain' => 'FSiDemoBundle',
            'label' => 'Author',
            'label_attr' => array('class' => 'control-label'),
            'group' => 'news.form.group.basic'
        ));

        $builder->add('image', 'imagefile', array(
            'required' => false,
            'imagine_filter' => 'news_thumb',
            'file_name_path' => 'imageName',
            'preview_attr' => array('class' => 'imagefile_preview'),
            'label' => 'news.form.image.label',
            'label_attr' => array('class' => 'control-label'),
            'group' => 'news.form.group.files'
        ));

        $builder->add('file', 'file', array(
            'required' => false,
            'file_name_path' => 'fileName',
            'label' => 'news.form.file.label',
            'label_attr' => array('class' => 'control-label'),
            'group' => 'news.form.group.files'
        ));
    }

    public function getName()
    {
        return 'news_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'groups' => array(
                'news.form.group.basic',
                'news.form.group.files',
            )
        ));
    }
}
```