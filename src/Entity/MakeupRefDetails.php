<?php

namespace App\Entity;

use App\Repository\MakeupRefDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MakeupRefDetailsRepository::class)
 */
class MakeupRefDetails
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
     * @ORM\ManyToOne(targetEntity=MakeupRef::class, inversedBy="makeupRefDetails")
     */
    private $MakeupRef;

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

    public function getMakeupRef(): ?MakeupRef
    {
        return $this->MakeupRef;
    }

    public function setMakeupRef(?MakeupRef $MakeupRef): self
    {
        $this->MakeupRef = $MakeupRef;

        return $this;
    }
}
