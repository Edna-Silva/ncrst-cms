<?php

namespace App\Entity;

use App\Repository\InnovationChallengeCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InnovationChallengeCategoriesRepository::class)
 */
class InnovationChallengeCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=InnovationChallenges::class, inversedBy="innovation_challenge_categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $innovation_challenge;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInnovationChallenge(): ?InnovationChallenges
    {
        return $this->innovation_challenge;
    }

    public function setInnovationChallenge(?InnovationChallenges $innovation_challenge): self
    {
        $this->innovation_challenge = $innovation_challenge;

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
}
