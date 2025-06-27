<?php

namespace App\Entity;

use App\Repository\InnovatorsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=InnovatorsRepository::class)
 *@ApiResource(
 *  normalizationContext={"groups"={"innovators:read"}},
 *  denormalizationContext={"groups"={"innovators:write"}}
 * )
 */
class Innovators
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"innovators:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"innovators:read", "innovators:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"innovators:read", "innovators:write"})
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"innovators:read", "innovators:write"})
     */
    private $sector;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"innovators:read", "innovators:write"})
     */
    private $innovation;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"innovators:read", "innovators:write"})
     */
    private $impact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"innovators:read", "innovators:write"})
     */
    private $funding;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"innovators:read", "innovators:write"})
     */
    private $image_url;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"innovators:read", "innovators:write"})
     */
    private $created_at;

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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(?string $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getInnovation(): ?string
    {
        return $this->innovation;
    }

    public function setInnovation(?string $innovation): self
    {
        $this->innovation = $innovation;

        return $this;
    }

    public function getImpact(): ?string
    {
        return $this->impact;
    }

    public function setImpact(?string $impact): self
    {
        $this->impact = $impact;

        return $this;
    }

    public function getFunding(): ?string
    {
        return $this->funding;
    }

    public function setFunding(?string $funding): self
    {
        $this->funding = $funding;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
