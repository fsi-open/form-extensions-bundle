# Sortable collection extension:

Assume you have some entity with one-to-many association **ordered by position field**:

```php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Gallery
{
    /**
     * @ORM\OneToMany(targetEntity="GalleryPhoto", mappedBy="gallery")
     * @ORM\OrderBy({"position" = "ASC"})
     * @var GalleryPhoto[]|ArrayCollection
     */
    private $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    /**
     * @param GalleryPhoto $photo
     */
    public function addPhoto(GalleryPhoto $photo)
    {
        if (!$this->photos->contains($photo)) {
            $photo->setGallery($this);
            $this->photos->add($photo);
        }
    }

    /**
     * @param GalleryPhoto $photo
     */
    public function removePhoto(GalleryPhoto $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * @return GalleryPhoto[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
```

And you have collection item class that **implements ``FSi\Bundle\FormExtensionsBundle\Model\PositionableInterface``**

```php
use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\FormExtensionsBundle\Model\PositionableInterface;

/**
 * @ORM\Entity
 */
class GalleryPhoto implements PositionableInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="photos")
     * @var Gallery
     */
    private $gallery;

    /**
     * @ORM\Column(name="position", type="integer", nullable=false)
     * @var int
     */
    private $position;

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     */
    public function setGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
```

And you define the form like this

```php
use AppBundle\Entity\Gallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photos', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, array(
            'type' => GalleryPhotoType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
    }
}
```

When the order of photos is changed in the DOM (i.e. using some JS) then the ``$position`` in ``GalleryPhoto`` entities
will be updated accordingly.
