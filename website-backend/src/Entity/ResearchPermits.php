<?php

namespace App\Entity;

use App\Repository\ResearchPermitsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=ResearchPermitsRepository::class)
 * @ApiResource(
 *   normalizationContext={"groups"={"research-permits:read"}},
 *   denormalizationContext={"groups"={"research-permits:write"}}
 * )
 */
class ResearchPermits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"research-permits:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"research-permits:read", "research-permits:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"research-permits:read", "research-permits:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"research-permits:read", "research-permits:write"})
     */
    private $file_type;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"research-permits:read", "research-permits:write"})
     */
    private $size;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"research-permits:read", "research-permits:write"})
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
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

    public function getFileType(): ?string
    {
        return $this->file_type;
    }

    public function setFileType(?string $file_type): self
    {
        $this->file_type = $file_type;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

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
