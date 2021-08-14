<?php

namespace App\Entity;

use App\Repository\MakeupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MakeupRepository::class)
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
}
