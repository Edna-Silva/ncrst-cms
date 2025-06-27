<?php

namespace App\Entity;

use App\Repository\BiotechLabsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=BiotechLabsRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"biotech_labs:read"}},
 *     denormalizationContext={"groups"={"biotech_labs:write"}}
 * )
 */
class BiotechLabs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"biotech_labs:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"biotech_labs:read", "biotech_labs:write"})

     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"biotech_labs:read", "biotech_labs:write"})

     * 
     */
    private $location;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"biotech_labs:read", "biotech_labs:write"})
     */
    private $equipment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"biotech_labs:read", "biotech_labs:write"})
     */
    private $certification;

    /**
     * @ORM\OneToMany(targetEntity=BiotechLabServices::class, mappedBy="biotech_labs")
     * @Groups({"biotech_labs:read", "biotech_labs:write"})
     */
    private $biotech_lab_services;

    public function __construct()
    {
        $this->biotech_lab_services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getEquipment(): ?string
    {
        return $this->equipment;
    }

    public function setEquipment(?string $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getCertification(): ?string
    {
        return $this->certification;
    }

    public function setCertification(?string $certification): self
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * @return Collection<int, BiotechLabServices>
     */
    public function getBiotechLabServices(): Collection
    {
        return $this->biotech_lab_services;
    }

    public function addBiotechLabService(BiotechLabServices $biotechLabService): self
    {
        if (!$this->biotech_lab_services->contains($biotechLabService)) {
            $this->biotech_lab_services[] = $biotechLabService;
            $biotechLabService->setBiotechLabs($this);
        }

        return $this;
    }

    public function removeBiotechLabService(BiotechLabServices $biotechLabService): self
    {
        if ($this->biotech_lab_services->removeElement($biotechLabService)) {
            // set the owning side to null (unless already changed)
            if ($biotechLabService->getBiotechLabs() === $this) {
                $biotechLabService->setBiotechLabs(null);
            }
        }

        return $this;
    }
}
