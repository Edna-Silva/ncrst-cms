<?php

namespace App\Entity;

use App\Repository\IksKnowledgeAreaExamplesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=IksKnowledgeAreaExamplesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"iks-knowledge-area-examples:read"}},
 *  denormalizationContext={"groups"={"iks-knowledge-area-examples:write"}}
 * )
 */
class IksKnowledgeAreaExamples
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"iks-knowledge-area-examples:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=IksKnowledgeAreas::class, inversedBy="iks_knowledge_area_examples")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"iks-knowledge-area-examples:read", "iks-knowledge-area-examples:write"})
     */
    private $iks_knowlegde_area;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"iks-knowledge-area-examples:read", "iks-knowledge-area-examples:write"})
     */
    private $example;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIksKnowlegdeArea(): ?IksKnowledgeAreas
    {
        return $this->iks_knowlegde_area;
    }

    public function setIksKnowlegdeArea(?IksKnowledgeAreas $iks_knowlegde_area): self
    {
        $this->iks_knowlegde_area = $iks_knowlegde_area;

        return $this;
    }

    public function getExample(): ?string
    {
        return $this->example;
    }

    public function setExample(?string $example): self
    {
        $this->example = $example;

        return $this;
    }
}
