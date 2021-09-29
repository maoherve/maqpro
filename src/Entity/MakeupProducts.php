<?php

namespace App\Entity;

use App\Repository\MakeupProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MakeupProductsRepository::class)
 */
class MakeupProducts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Makeup::class, inversedBy="makeupProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $makeup;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=MakeupRef::class, mappedBy="MakeupProduct", orphanRemoval=true)
     */
    private $makeupRefs;

    /**
     * @ORM\OneToMany(targetEntity=Colours::class, mappedBy="MakeupProduct")
     */
    private $colours;

    /**
     * @ORM\OneToMany(targetEntity=Packaging::class, mappedBy="MakeupProduct")
     */
    private $packagings;

    public function __construct()
    {
        $this->makeupRefs = new ArrayCollection();
        $this->colours = new ArrayCollection();
        $this->packagings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMakeup(): ?Makeup
    {
        return $this->makeup;
    }

    public function setMakeup(?Makeup $makeup): self
    {
        $this->makeup = $makeup;

        return $this;
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
     * @return Collection|MakeupRef[]
     */
    public function getMakeupRefs(): Collection
    {
        return $this->makeupRefs;
    }

    public function addMakeupRef(MakeupRef $makeupRef): self
    {
        if (!$this->makeupRefs->contains($makeupRef)) {
            $this->makeupRefs[] = $makeupRef;
            $makeupRef->setMakeupProduct($this);
        }

        return $this;
    }

    public function removeMakeupRef(MakeupRef $makeupRef): self
    {
        if ($this->makeupRefs->removeElement($makeupRef)) {
            // set the owning side to null (unless already changed)
            if ($makeupRef->getMakeupProduct() === $this) {
                $makeupRef->setMakeupProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Colours[]
     */
    public function getColours(): Collection
    {
        return $this->colours;
    }

    public function addColour(Colours $colour): self
    {
        if (!$this->colours->contains($colour)) {
            $this->colours[] = $colour;
            $colour->setMakeupProduct($this);
        }

        return $this;
    }

    public function removeColour(Colours $colour): self
    {
        if ($this->colours->removeElement($colour)) {
            // set the owning side to null (unless already changed)
            if ($colour->getMakeupProduct() === $this) {
                $colour->setMakeupProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Packaging[]
     */
    public function getPackagings(): Collection
    {
        return $this->packagings;
    }

    public function addPackaging(Packaging $packaging): self
    {
        if (!$this->packagings->contains($packaging)) {
            $this->packagings[] = $packaging;
            $packaging->setMakeupProduct($this);
        }

        return $this;
    }

    public function removePackaging(Packaging $packaging): self
    {
        if ($this->packagings->removeElement($packaging)) {
            // set the owning side to null (unless already changed)
            if ($packaging->getMakeupProduct() === $this) {
                $packaging->setMakeupProduct(null);
            }
        }

        return $this;
    }
}
