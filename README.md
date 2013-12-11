#FSi Symfony2 Form Extensions Bundle

FSiFormExtensionsBundle provide some useful symfony2 form types and extensions.

Build Status:  
[![Build Status](https://travis-ci.org/fsi-open/form-extensions-bundle.png?branch=master)](https://travis-ci.org/fsi-open/form-extensions-bundle) - Master

[![Latest Stable Version](https://poser.pugx.org/fsi/form-extensions-bundle/v/stable.png)](https://packagist.org/packages/fsi/form-extensions-bundle)

Documentation:

* [Installation](Resources/doc/installation.md)

Form types: 
* [fsi_ckeditor](Resources/doc/fsi_ckeditor.md)

# Tests

Because few tests require javascript its recommended to use vagrant virtual machine.
To configure virtual machine you need only go to vagrant folder in bundle

```
$ cd vagrant
$ vagrant up
```

Then login into VM and go to bundle folder and run Behat/PHPSpec.

```
$ cd /var/www/admin-bundle/
$ bin/behat
$ bin/phpspec
```