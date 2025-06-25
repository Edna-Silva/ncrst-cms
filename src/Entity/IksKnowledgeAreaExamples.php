<?php

namespace App\Entity;

use App\Repository\IksKnowledgeAreaExamplesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IksKnowledgeAreaExamplesRepository::class)
 */
class IksKnowledgeAreaExamples
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=IksKnowledgeAreas::class, inversedBy="iks_knowledge_area_examples")
     * @ORM\JoinColumn(nullable=false)
     */
    private $iks_knowlegde_area;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
