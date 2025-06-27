<?php

namespace App\Entity;

use App\Repository\IksKnowledgeAreasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=IksKnowledgeAreasRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"iks-knowledge-areas:read"}},
 *  denormalizationContext={"groups"={"iks-knowledge-areas:write"}}
 * )
 */
class IksKnowledgeAreas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"iks-knowledge-areas:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"iks-knowledge-areas:read", "iks-knowledge-areas:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     *  @Groups({"iks-knowledge-areas:read", "iks-knowledge-areas:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *  @Groups({"iks-knowledge-areas:read", "iks-knowledge-areas:write"})
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *  @Groups({"iks-knowledge-areas:read", "iks-knowledge-areas:write"})
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=IksKnowledgeAreaExamples::class, mappedBy="iks_knowlegde_area")
     * @Groups({"iks-knowledge-areas:read", "iks-knowledge-areas:write"})
     */
    private $iks_knowledge_area_examples;

    public function __construct()
    {
        $this->iks_knowledge_area_examples = new ArrayCollection();
    }

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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, IksKnowledgeAreaExamples>
     */
    public function getIksKnowledgeAreaExamples(): Collection
    {
        return $this->iks_knowledge_area_examples;
    }

    public function addIksKnowledgeAreaExample(IksKnowledgeAreaExamples $iksKnowledgeAreaExample): self
    {
        if (!$this->iks_knowledge_area_examples->contains($iksKnowledgeAreaExample)) {
            $this->iks_knowledge_area_examples[] = $iksKnowledgeAreaExample;
            $iksKnowledgeAreaExample->setIksKnowlegdeArea($this);
        }

        return $this;
    }

    public function removeIksKnowledgeAreaExample(IksKnowledgeAreaExamples $iksKnowledgeAreaExample): self
    {
        if ($this->iks_knowledge_area_examples->removeElement($iksKnowledgeAreaExample)) {
            // set the owning side to null (unless already changed)
            if ($iksKnowledgeAreaExample->getIksKnowlegdeArea() === $this) {
                $iksKnowledgeAreaExample->setIksKnowlegdeArea(null);
            }
        }

        return $this;
    }
}
