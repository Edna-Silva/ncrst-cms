<?php

namespace App\Entity;

use App\Repository\UploadsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UploadsRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"uploads:read"}},
 *  denormalizationContext={"groups"={"uploads:write"}}
 * )
 */
class Uploads
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"uploads:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="uploads")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"uploads:read", "uploads:write"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"uploads:read", "uploads:write"})
     */
    private $file_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"uploads:read", "uploads:write"})
     */
    private $file_path;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"uploads:read", "uploads:write"})
     */
    private $file_type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"uploads:read", "uploads:write"})
     */
    private $file_size;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"uploads:read", "uploads:write"})
     */
    private $uploaded_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(?string $file_name): self
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function setFilePath(string $file_path): self
    {
        $this->file_path = $file_path;

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

    public function getFileSize(): ?int
    {
        return $this->file_size;
    }

    public function setFileSize(?int $file_size): self
    {
        $this->file_size = $file_size;

        return $this;
    }

    public function getUploadedAt(): ?\DateTimeInterface
    {
        return $this->uploaded_at;
    }

    public function setUploadedAt(\DateTimeInterface $uploaded_at): self
    {
        $this->uploaded_at = $uploaded_at;

        return $this;
    }
}
