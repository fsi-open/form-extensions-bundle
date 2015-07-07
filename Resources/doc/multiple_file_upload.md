# Multiple file upload

In order to use multiple file upload feature you must set `multi_upload_field` collection field option to file field name in collection form type.

```php
$builder->add('files', 'collection', [
    'type' => '...',
    'multi_upload_field' => 'file',
]);
```

Below is example of article form that have files form collection:

```php
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FSi\Bundle\FormExtensionsBundle\Form\EventListener\MultiUploadCollectionListener;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('files', 'collection', [
            'type' => 'file_form_type',
            'allow_add' => true,
            'allow_delete' => true,
            'error_bubbling' => false,
            'multi_upload_field' => 'file',
        ]);
    }

    public function getName()
    {
        return 'article_form_type';
    }
}
```

### Note
Collection form type could only have field specified by the `multi_upload_field` option as required. Other field must be optional.

```php
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FileElementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', 'fsi_file', [
            'multiple' => true,
        ]);

        $builder->add('name', 'text', [
            'required' => false,
        ]);
    }

    public function getName()
    {
        return 'file_form_type';
    }
}

```
