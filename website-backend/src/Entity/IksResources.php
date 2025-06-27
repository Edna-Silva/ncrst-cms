<?php

namespace App\Entity;

use App\Repository\IksResourcesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=IksResourcesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"iks-resources:read"}},
 *  denormalizationContext={"groups"={"iks-resources:write"}}
 * )
 */
class IksResources
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"iks-resources:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"iks-resources:read", "iks-resources:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"iks-resources:read", "iks-resources:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"iks-resources:read", "iks-resources:write"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"iks-resources:read", "iks-resources:write"})
     */
    private $acess;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAcess(): ?string
    {
        return $this->acess;
    }

    public function setAcess(?string $acess): self
    {
        $this->acess = $acess;

        return $this;
    }
}
