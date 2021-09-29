<?php

namespace App\Entity;

use App\Repository\ColoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ColoursRepository::class)
 * @Vich\Uploadable
 */
class Colours
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
     * @ORM\ManyToOne(targetEntity=MakeupProducts::class, inversedBy="colours")
     */
    private $MakeupProduct;


    /**
     * @ORM\Column(type="string")
     *
     */
    private $imageName;

    /**
     * @Vich\UploadableField(mapping="colours_images", fileNameProperty="imageName")
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

    public function getMakeupProduct(): ?MakeupProducts
    {
        return $this->MakeupProduct;
    }

    public function setMakeupProduct(?MakeupProducts $MakeupProduct): self
    {
        $this->MakeupProduct = $MakeupProduct;

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
