# fsi_ckeditor type

## Usage

```php
$formBuilder->add('content', 'fsi_ckeditor', array());
```

Above code is enough to use fsi_ckeditor in symfony2 form.

## Options

Following options are available in fsi_ckeditor form type:

```php
$formBuilder->add('content', 'fsi_ckeditor', array(
        'uiColor' => null,
        'forcePasteAsPlainText' => true,
        'language' => 'pl',
        'toolbar' => array(
            array('name' => 'document', 'items' => array('Source', '-', 'NewPage', '-', 'Templates' )),
            array('name' => 'clipboard', 'items' => array('Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' )),
            '/',
            array(
                'name' => 'basicstyles',
                'items' => array(
                    'Bold', 'Italic', 'Underline', 'Strike', '-',
                    'Table', 'NumberedList', 'BulletedList', '-',
                    'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock')
            ),
            array('name' => 'links', 'items' => array('Link', 'Unlink', '-', 'Image')),
            '/',
            array('name' => 'styles', 'items' => array('Format')),
        ),
        'width' => null,
        'height' => null,
        'baseHref' => '',
        'bodyClass' => null,
        'bodyId' => null,
        'contentsCss' => null,
        'enterMode' => null,
        'formatTags' => null,
        'fontNames' => null,
        'fontSizeSizes' => null,
    )
);
```

- ``uiColor`` - should be RGB value: ``#ffffff``
- ``forcePasteAsPlainText`` - boolean
- ``language`` - string
- ``toolbar`` - array
- ``width`` - string (does not require px suffix)
- ``height`` - string (does not require px suffix)
- ``baseHref`` - string
- ``bodyClass`` - string
- ``bodyId`` - string
- ``contentsCss`` - string
- ``enterMode`` - string available values: 'ENTER_DIV', 'ENTER_BR' or 'ENTER_P'
- ``formatTags`` - string (default ``p;h1;h2;h3;h4;h5;h6;pre;address;div``)
- ``fontNames`` - string (``{display_name}/{font_name},{alternative_font_name};{display_name}/{font_name}``)
- ``fontSizeSizes`` - string (``{display_name}/{font_size};{display_name}/{font_size}``)

## CKEditor script

By default CKEditor script is loaded from cdn ``//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.2/ckeditor.js``
Of course you can change location of script via app config.

example:
```
# app/config/config.yml

fsi_form_extensions:
    fsi_ckeditor:
        ckeditor_script_path: //cdn.jsdelivr.net/ckeditor/4.3.0/ckeditor.js
```
