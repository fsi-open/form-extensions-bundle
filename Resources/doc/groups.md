#Symfony2 form grouping extension#

This extension provides fieldsets to symfony form component.

##1. Usage##

All you need to do is define groups in form root element as an array where key is group id and value group name.
```php
$resolver->setDefaults(array(
    'groups' => array(
        'basic' => 'news.form.group.basic', // group names are translated in twig 
        'files' => 'news.form.group.files',
    )
));
```

Now you can add children to form that will be assigned to ``basic`` or ``files`` group. 
```php
$builder->add('title', 'text', array(
    /* field options */
    'group' => 'basic'
));
```

```php
$builder->add('file', 'file', array(
    /* field options */
    'group' => 'files'
));
```

Full demo code. 

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
            /* field options */
            'group' => 'basic'
        ));

        $builder->add('categories', 'entity', array(
            /* field options */
            'group' => 'basic'
        ));

        $builder->add('author', 'entity', array(
            /* field options */
            'group' => 'basic'
        ));

        $builder->add('image', 'imagefile', array(
            /* field options */
            'group' => 'files'
        ));

        $builder->add('file', 'file', array(
            /* field options */
            'group' => 'files'
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
                'basic' => 'news.form.group.basic',
                'files' => 'news.form.group.files',
            )
        ));
    }
}
```