<?php

namespace App\Entity;

use App\Repository\MakeupRefRepository;
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
     * @ORM\Column(type="string", length=255)
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cont;

    /**
     * @ORM\ManyToOne(targetEntity=MakeupProducts::class, inversedBy="makeupRefs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MakeupProduct;

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

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getCont(): ?string
    {
        return $this->cont;
    }

    public function setCont(string $cont): self
    {
        $this->cont = $cont;

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
}
