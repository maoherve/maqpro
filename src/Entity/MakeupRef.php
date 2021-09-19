<?php

namespace App\Entity;

use App\Repository\MakeupRefRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MakeupRefRepository::class)
 */
class MakeupRef
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
     * @ORM\ManyToOne(targetEntity=MakeupProducts::class, inversedBy="makeupRefs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MakeupProduct;

    /**
     * @ORM\OneToMany(targetEntity=MakeupRefDetails::class, mappedBy="MakeupRef")
     */
    private $makeupRefDetails;

    public function __construct()
    {
        $this->makeupRefDetails = new ArrayCollection();
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

    public function getMakeupProduct(): ?MakeupProducts
    {
        return $this->MakeupProduct;
    }

    public function setMakeupProduct(?MakeupProducts $MakeupProduct): self
    {
        $this->MakeupProduct = $MakeupProduct;

        return $this;
    }

    /**
     * @return Collection|MakeupRefDetails[]
     */
    public function getMakeupRefDetails(): Collection
    {
        return $this->makeupRefDetails;
    }

    public function addMakeupRefDetail(MakeupRefDetails $makeupRefDetail): self
    {
        if (!$this->makeupRefDetails->contains($makeupRefDetail)) {
            $this->makeupRefDetails[] = $makeupRefDetail;
            $makeupRefDetail->setMakeupRef($this);
        }

        return $this;
    }

    public function removeMakeupRefDetail(MakeupRefDetails $makeupRefDetail): self
    {
        if ($this->makeupRefDetails->removeElement($makeupRefDetail)) {
            // set the owning side to null (unless already changed)
            if ($makeupRefDetail->getMakeupRef() === $this) {
                $makeupRefDetail->setMakeupRef(null);
            }
        }

        return $this;
    }
}
