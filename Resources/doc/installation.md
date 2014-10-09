# Installation in 2 simple steps

**IMPORTANT!!** This bundle is deprecated. In order to integrate CKEditor with FSi Admin Bundle use [this solution](https://github.com/fsi-open/resource-repository-bundle/blob/master/Resources/docs/ckeditor.md).


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
