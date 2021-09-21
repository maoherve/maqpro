<?php

namespace App\Entity;

use App\Repository\ColoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColoursRepository::class)
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
    private $Name;

    /**
     * @ORM\ManyToOne(targetEntity=MakeupProducts::class, inversedBy="colours")
     */
    private $MakeupProduct;

    public function __construct()
    {
        $this->MakeupProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|MakeupProducts[]
     */
    public function getMakeupProduct(): Collection
    {
        return $this->MakeupProduct;
    }

    public function addMakeupProduct(MakeupProducts $makeupProduct): self
    {
        if (!$this->MakeupProduct->contains($makeupProduct)) {
            $this->MakeupProduct[] = $makeupProduct;
        }

        return $this;
    }

    public function removeMakeupProduct(MakeupProducts $makeupProduct): self
    {
        $this->MakeupProduct->removeElement($makeupProduct);

        return $this;
    }
}
