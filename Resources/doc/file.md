#Symfony2 form file type extension#

Both types ``file`` and ``imagefile`` depends on external bundles. You should read those bundles docs before using
``FormExtensionsBundle``.

- [VichUploaderBundle](https://github.com/dustin10/VichUploaderBundle)
- [AvalancheImagineBundle](https://github.com/avalanche123/AvalancheImagineBundle)
- [KnpGaufretteBundle](https://github.com/KnpLabs/KnpGaufretteBundle)


##1. Form file type usage##

```
# app/config/config.yml

vich_uploader:
    db_driver: orm
    mappings:
        file_news:
            uri_prefix: /uploaded/files/news
            upload_destination: %kernel.root_dir%/../web/uploaded/files/news
            inject_on_load: true
```

```php
// src/FSi/DemoBundle/Entity/News.php

namespace FSi\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity()
 * @ORM\Table(name="news")
 * @Vich\Uploadable
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    protected $id;

    /**
     * @Vich\UploadableField(mapping="file_news", fileNameProperty="fileName")
     */
    protected $file;

    /**
     * @ORM\Column(type="string", length=255, name="file_name", nullable=true)
     */
    protected $fileName;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getFileName()
    {
        return $this->fileName;
    }
}
```

**Important** - dont forget to set ``@Vich\Uploadable`` class annotation!

```php
// src/FSi/DemoBundle/Form/Type/NewsType.php

namespace FSi\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', 'file', array(
            'required' => false,
            'file_name_path' => 'fileName', // name of property in entity that contains file name.
            'label' => 'news.form.file.label',
            'label_attr' => array('class' => 'control-label'),
        ));

        // other fields here...
    }
}
```

##2. Form imagefile type usage##

```
# app/config/config.yml

avalanche_imagine:
    filters:
        news_thumb:
            type:    thumbnail
            options: { size: [120, 120], mode: outbound }

vich_uploader:
    db_driver: orm
    mappings:
        image_news:
            uri_prefix: /uploaded/images/news
            upload_destination: %kernel.root_dir%/../web/uploaded/images/news
            inject_on_load: true
```

```php
// src/FSi/DemoBundle/Entity/News.php

namespace FSi\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity()
 * @ORM\Table(name="news")
 * @Vich\Uploadable
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    protected $id;

    /**
     * @Vich\UploadableField(mapping="image_news", fileNameProperty="imageName")
     */
    protected $image;

    /**
     * @ORM\Column(type="string", length=255, name="image_name", nullable=true)
     */
    protected $imageName;

    /**
     * @param string $imageName
     * @return $this
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }
}
```

**Important** - dont forget to set ``@Vich\Uploadable`` class annotation!

```php
// src/FSi/DemoBundle/Form/Type/NewsType.php

namespace FSi\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('image', 'imagefile', array(
            'required' => false,
            'imagine_filter' => 'news_thumb', // can be null
            'file_name_path' => 'imageName', // name of property in entity that contains file name.
            'preview_attr' => array('class' => 'imagefile_preview'),
            'label' => 'news.form.image.label',
            'label_attr' => array('class' => 'control-label'),
        ));

        // other fields here...
    }
}
```
