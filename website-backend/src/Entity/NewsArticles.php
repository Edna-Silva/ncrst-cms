<?php

namespace App\Entity;

use App\Repository\NewsArticlesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=NewsArticlesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"news-articles:read"}},
 *  denormalizationContext={"groups"={"news-articles:write"}}
 * )
 */
class NewsArticles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"news-articles:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"news-articles:read", "news-articles:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"news-articles:read", "news-articles:write"})
     */
    private $excerpt;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"news-articles:read", "news-articles:write"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=NewsCategories::class, inversedBy="newsArticles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"news-articles:read", "news-articles:write"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"news-articles:read", "news-articles:write"})
     */
    private $read_time;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"news-articles:read", "news-articles:write"})
     */
    private $image_url;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"news-articles:read", "news-articles:write"})
     */
    private $featured;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"news-articles:read", "news-articles:write"})
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

    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(?string $excerpt): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): ?NewsCategories
    {
        return $this->category;
    }

    public function setCategory(?NewsCategories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getReadTime(): ?string
    {
        return $this->read_time;
    }

    public function setReadTime(?string $read_time): self
    {
        $this->read_time = $read_time;

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

    public function isFeatured(): ?bool
    {
        return $this->featured;
    }

    public function setFeatured(?bool $featured): self
    {
        $this->featured = $featured;

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
