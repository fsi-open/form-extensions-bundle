#Symfony2 form ckeditor type#

##1. Usage##

```php
// src/FSi/DemoBundle/Form/Type/NewsType.php

namespace FSi\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', 'ckeditor', array(
            'required' => false,
            'ui_color' => '#AADC6E',
            'force_paste_as_plaintext' => true,
            'language' => 'pl',
            'toolbar' => array(
                array('name' => 'document', 'items' => array('Source', '-', 'NewPage', '-', 'Templates' )),
                array('name' => 'clipboard', 'items' => array('Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' )),
                '/',
                array(
                    'name' => 'basicstyles',
                    'items' => array(
                        'Bold', 'Italic', 'Underline', 'Strike', '-',
                        'Table', 'NumberedList', 'BulletedList', '-',
                        'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock')
                ),
                array('name' => 'links', 'items' => array('Link', 'Unlink', '-', 'Image'))
            ),
            'width' => null,
            'height' => null,
            'skin' => null,
            'base_href' => null,
            'body_class' => null,
            'body_id' => null,
            'contents_css' => null,
            'enter_mode' => null,
        ));

        // other fields here...
    }
}
```