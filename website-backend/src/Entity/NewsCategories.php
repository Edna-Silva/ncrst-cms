<?php

namespace App\Entity;

use App\Repository\NewsCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=NewsCategoriesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"news-categories:read"}},
 *  denormalizationContext={"groups"={"news-categories:write"}}
 * )
 */
class NewsCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"news-categories:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"news-categories:read", "news-categories:write"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=NewsArticles::class, mappedBy="category")
     * @Groups({"news-categories:read", "news-categories:write"})
     */
    private $newsArticles;

    public function __construct()
    {
        $this->newsArticles = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, NewsArticles>
     */
    public function getNewsArticles(): Collection
    {
        return $this->newsArticles;
    }

    public function addNewsArticle(NewsArticles $newsArticle): self
    {
        if (!$this->newsArticles->contains($newsArticle)) {
            $this->newsArticles[] = $newsArticle;
            $newsArticle->setCategory($this);
        }

        return $this;
    }

    public function removeNewsArticle(NewsArticles $newsArticle): self
    {
        if ($this->newsArticles->removeElement($newsArticle)) {
            // set the owning side to null (unless already changed)
            if ($newsArticle->getCategory() === $this) {
                $newsArticle->setCategory(null);
            }
        }

        return $this;
    }
}
