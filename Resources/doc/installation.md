## 1. Download FSi Form Extensions Bundle

Add to composer.json

```
"require": {
    "fsi/form-extensions-bundle": "^2.1"
}
```

## 2. Register bundles

```php
<?php
// app/AppKernel.php

public function registerBundles(): array
{
    $bundles = [
        new FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle()
    ];
}

// config/bundles.php
return [
    FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle::class => ['all' => true]
];
```
