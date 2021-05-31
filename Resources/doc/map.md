# Map type

## Usage

```php
$formBuilder->add('content', \FSi\Bundle\FormExtensionsBundle\Form\Type\FSiMapType::class, array(
        'latitude_name' => 'latitude',
        'latitude_type' => Symfony\Component\Form\Extension\Core\Type\NumberType::class,
        'latitude_options' => [
            // options passed to the latitude form field
        ],
        'longitude_name' => 'longitude',
        'longitude_type' => Symfony\Component\Form\Extension\Core\Type\NumberType::class,
        'longitude_options' => [
            // options passed to the longitude form field
        ],
        'zoom_name' => 'zoom',
        'zoom_type' => Symfony\Component\Form\Extension\Core\Type\NumberType::class,
        'zoom_options' => [
            // options passed to the zoom form field
        ],
    )
);
```

## Google map api-key

By default google map script is loaded without api-key. You can set it via app config like this:

```yaml
# app/config/config.yml or config/packages/fsi_form_extensions.yaml

fsi_form_extensions:
    fsi_map:
        api_key: ABCDEFGH123456
```
