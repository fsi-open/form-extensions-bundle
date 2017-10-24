# FSi Form Extensions Bundle

This bundle offers a couple of types and extensions for the Symfony's form component.
For more information, see below.

Build Status:  
[![Build Status](https://travis-ci.org/fsi-open/form-extensions-bundle.png?branch=master)](https://travis-ci.org/fsi-open/form-extensions-bundle) - Master  
[![Build Status](https://travis-ci.org/fsi-open/form-extensions-bundle.png?branch=1.0)](https://travis-ci.org/fsi-open/form-extensions-bundle) - 1.0

[![Latest Stable Version](https://poser.pugx.org/fsi/form-extensions-bundle/v/stable.png)](https://packagist.org/packages/fsi/form-extensions-bundle)

Documentation:
* [Installation](Resources/doc/installation.md)

Form types: 
* [map](Resources/doc/map.md)

Form extensions:
* [sortable_collection](Resources/doc/sortable_collection.md)

Form listeners:
* [multiple file upload](Resources/doc/multiple_file_upload.md)

# Tests

Go to the folder containing the bundle and run Behat/PHPSpec suites.

```
$ cd <path to project>
$ bin/behat
$ bin/phpspec
```

Behat tests require Selenium in order to work.
