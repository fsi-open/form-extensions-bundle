#FSi Symfony2 Form Extensions Bundle

##Installation

modify composer.json file

```
{
    "require": {
        "fsi/form-extensions-bundle": "1.0.*@dev"
    },

}
```
Execute:

```
php composer.phar update
```

Modify Files:

```php
    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
            new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle(),
            // ...
        );
    }
```

```
# app/config/routing.yml

_imagine:
    resource: .
    type:     imagine
```

##Usage#

- [file](Resources/doc/file.md)
- [ckeditor](Resources/doc/ckeditor.md)
- [groups](Resources/doc/groups.md)