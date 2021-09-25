<?php

namespace App\Entity;

use App\Repository\ColoursRepository;
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=MakeupProducts::class, inversedBy="colours")
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
