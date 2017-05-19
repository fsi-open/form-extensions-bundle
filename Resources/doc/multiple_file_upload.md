# Multiple file upload

In order to use multiple file upload feature you must set `multi_upload_field` collection field option to file field name in collection form type.

```php
$builder->add('files', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, [
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
        $builder->add('files', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, [
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
Collection form type could only have field specified by the `multi_upload_field`
option as required. Other field can be optional. `empty_data` option must be
changed to a `null`, otherwise if you put a `File` constraint on the field, it will
receive an empty array and break due to improper value type.

```php
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FileElementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', \FSi\Bundle\DoctrineExtensionsBundle\Form\Type\FSi\FileType::class, [
            'multiple' => true,
            'empty_data' => null
        ]);

        $builder->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
            'required' => false,
        ]);
    }

    public function getName()
    {
        return 'file_form_type';
    }
}

```
