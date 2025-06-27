<?php

namespace App\Entity;

use App\Repository\ResourcesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=ResourcesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"resources:read"}},
 *  denormalizationContext={"groups"={"resources:write"}}
 * )
 */
class Resources
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"resources:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"resources:read", "resources:write"})
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=ResourceCategories::class, inversedBy="resources")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"resources:read", "resources:write"})
     */
    private $resource_categories;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"resources:read", "resources:write"})
     */
    private $yer;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"resources:read", "resources:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"resources:read", "resources:write"})
     */
    private $file_type;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"resources:read", "resources:write"})
     */
    private $size;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"resources:read", "resources:write"})
     */
    private $downloads;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"resources:read", "resources:write"})
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"resources:read", "resources:write"})
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

    public function getResourceCategories(): ?ResourceCategories
    {
        return $this->resource_categories;
    }

    public function setResourceCategories(?ResourceCategories $resource_categories): self
    {
        $this->resource_categories = $resource_categories;

        return $this;
    }

    public function getYer(): ?string
    {
        return $this->yer;
    }

    public function setYer(?string $yer): self
    {
        $this->yer = $yer;

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

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDownloads(): ?int
    {
        return $this->downloads;
    }

    public function setDownloads(?int $downloads): self
    {
        $this->downloads = $downloads;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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
