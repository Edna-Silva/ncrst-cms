<?php

namespace App\Entity;

use App\Repository\BiotechLabServicesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BiotechLabServicesRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"biotech_lab_services:read"}},
 *     denormalizationContext={"groups"={"biotech_lab_services:write"}}
 * )
 */
class BiotechLabServices
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"biotech_lab_services:read"})

     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=BiotechLabs::class, inversedBy="biotech_lab_services")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"biotech_lab_services:read", "biotech_lab_services:write"})

     */
    private $biotech_labs;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"biotech_lab_services:read", "biotech_lab_services:write"})
     */
    private $service;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBiotechLabs(): ?BiotechLabs
    {
        return $this->biotech_labs;
    }

    public function setBiotechLabs(?BiotechLabs $biotech_labs): self
    {
        $this->biotech_labs = $biotech_labs;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(?string $service): self
    {
        $this->service = $service;

        return $this;
    }
}
