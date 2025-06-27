<?php

namespace App\Entity;

use App\Repository\ResearchGrantsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ResearchGrantsRepository::class)
 * @ApiResource(
 *   normalizationContext={"groups"={"research-grants:read"}},
 *   denormalizationContext={"groups"={"research-grants:write"}}
 * )
 */
class ResearchGrants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"research-grants:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"research-grants:read", "research-grants:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"research-grants:read", "research-grants:write"})
     */
    private $deadline;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"research-grants:read", "research-grants:write"})
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"research-grants:read", "research-grants:write"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"research-grants:read", "research-grants:write"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"research-grants:read", "research-grants:write"})
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

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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
