<?php

namespace App\Entity;

use App\Repository\InnovationChallengeCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=InnovationChallengeCategoriesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"innovation-challenge-categories:read"}},
 *  denormalizationContext={"groups"={"innovation-challenge-categories:write"}}
 * )
 */
class InnovationChallengeCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"innovation-challenge-categories:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=InnovationChallenges::class, inversedBy="innovation_challenge_categories")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"innovation-challenge-categories:read", "innovation-challenge-categories:write"})
     */
    private $innovation_challenge;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"innovation-challenge-categories:read", "innovation-challenge-categories:write"})
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
