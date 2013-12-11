# Installation in 4 simple steps

## 1. Download FSi Form Extensions Bundle

Add to composer.json

```
"require": {
    "fsi/form-extensions-bundle": "1.0.*"
}
```

## 2. Register bundles

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        new FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle()
    );
}
```
