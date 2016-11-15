# map type

## Usage

```php
$formBuilder->add('position', 'fsi_map', array());
```

Above code is enough to use fsi_map in symfony2 form.

## Options

Following options are available in fsi_map form type:

```php
$formBuilder->add('content', \FSi\Bundle\FormExtensionsBundle\Form\Type\FSiMapType::class, array(
        'latitude_name' => 'latitude',
        'latitude_type' => 'number',
        'latitude_options' => array(),
        'longitude_name' => 'longitude',
        'longitude_type' => 'number',
        'longitude_options' => array(),
        'zoom_name' => 'zoom',
        'zoom_type' => 'number',
        'zoom_options' => array(),
    )
);
```

## Google map api-key

By default google map script is loaded without api-key. You can set it via app config like this:
```
# app/config/config.yml

fsi_form_extensions:
    fsi_map:
        api_key: ABCDEFGH123456
```
