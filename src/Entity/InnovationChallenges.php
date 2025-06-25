<?php

namespace App\Entity;

use App\Repository\InnovationChallengesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InnovationChallengesRepository::class)
 */
class InnovationChallenges
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $participants;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $deadline;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=InnovationChallengeCategories::class, mappedBy="innovation_challenge")
     */
    private $innovation_challenge_categories;

    public function __construct()
    {
        $this->innovation_challenge_categories = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getParticipants(): ?string
    {
        return $this->participants;
    }

    public function setParticipants(?string $participants): self
    {
        $this->participants = $participants;

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

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

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

    /**
     * @return Collection<int, InnovationChallengeCategories>
     */
    public function getInnovationChallengeCategories(): Collection
    {
        return $this->innovation_challenge_categories;
    }

    public function addInnovationChallengeCategory(InnovationChallengeCategories $innovationChallengeCategory): self
    {
        if (!$this->innovation_challenge_categories->contains($innovationChallengeCategory)) {
            $this->innovation_challenge_categories[] = $innovationChallengeCategory;
            $innovationChallengeCategory->setInnovationChallenge($this);
        }

        return $this;
    }

    public function removeInnovationChallengeCategory(InnovationChallengeCategories $innovationChallengeCategory): self
    {
        if ($this->innovation_challenge_categories->removeElement($innovationChallengeCategory)) {
            // set the owning side to null (unless already changed)
            if ($innovationChallengeCategory->getInnovationChallenge() === $this) {
                $innovationChallengeCategory->setInnovationChallenge(null);
            }
        }

        return $this;
    }
}
