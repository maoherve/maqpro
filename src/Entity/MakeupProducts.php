<?php

namespace App\Entity;

use App\Repository\MakeupProductsRepository;
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
}
