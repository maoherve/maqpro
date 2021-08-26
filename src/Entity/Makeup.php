<?php

namespace App\Entity;

use App\Repository\MakeupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=MakeupRepository::class)
 * @Vich\Uploadable
 */
class Makeup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=MakeupProducts::class, mappedBy="makeup")
     */
    private $makeupProducts;

    public function __construct()
    {
        $this->makeupProducts = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string")
     *
     */
    private $imageName;

    /**
     * @Vich\UploadableField(mapping="makeup_images", fileNameProperty="imageName")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|MakeupProducts[]
     */
    public function getMakeupProducts(): Collection
    {
        return $this->makeupProducts;
    }

    public function addMakeupProduct(MakeupProducts $makeupProduct): self
    {
        if (!$this->makeupProducts->contains($makeupProduct)) {
            $this->makeupProducts[] = $makeupProduct;
            $makeupProduct->setMakeup($this);
        }

        return $this;
    }

    public function removeMakeupProduct(MakeupProducts $makeupProduct): self
    {
        if ($this->makeupProducts->removeElement($makeupProduct)) {
            // set the owning side to null (unless already changed)
            if ($makeupProduct->getMakeup() === $this) {
                $makeupProduct->setMakeup(null);
            }
        }

        return $this;
    }



    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updated = new \Datetime();
        }
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * @param \DateTimeInterface|null $updated
     * @return $this
     */
    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;
        return $this;
    }

}
