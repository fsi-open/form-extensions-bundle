#FSi Symfony2 Form Extensions Bundle

##Installation

modify composer.json file

```
{
    "require": {
        "fsi/form-extensions-bundle": "1.0.x-dev"
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
            new FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle(),
            // ...
        );
    }
```

##Usage#

- [ckeditor](Resources/doc/ckeditor.md)
- [groups](Resources/doc/groups.md)

##Testing##

to run tests you should execute following commands after accessing bundle root.

```
$ cd src/FSi/Bundle/FormExtensionsBundle
$ composer update
$ bin/phpspec
```