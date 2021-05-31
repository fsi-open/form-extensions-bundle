# Sortable collection extension:

Assume you have some entity with one-to-many association **ordered by position field**:

```php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Gallery
{
    /**
     * @ORM\OneToMany(targetEntity="GalleryPhoto", mappedBy="gallery")
     * @ORM\OrderBy({"position" = "ASC"})
     *
     * @var Collection<GalleryPhoto>
     */
    private $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function addPhoto(GalleryPhoto $photo): void
    {
        if (true === $this->photos->contains($photo)) {
            return;
        }

        $photo->setGallery($this);
        $this->photos->add($photo);
    }

    public function removePhoto(GalleryPhoto $photo): void
    {
        $this->photos->removeElement($photo);
        $photo->setGallery(null);
    }

    /**
     * @return array<GalleryPhoto>
     */
    public function getPhotos(): array
    {
        return $this->photos->toArray();
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

     * @var Gallery|null
     */
    private $gallery;

    /**
     * @ORM\Column(name="position", type="smallint")

     * @var int|null
     */
    private $position;

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    public function setGallery(?Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
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
