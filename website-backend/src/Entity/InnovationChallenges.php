<?php

namespace App\Entity;

use App\Repository\InnovationChallengesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=InnovationChallengesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"innovation-challenges:read"}},
 *  denormalizationContext={"groups"={"innovation-challenges:write"}}
 * )
 */
class InnovationChallenges
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"innovation-challenges:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"innovation-challenges:read", "innovation-challenges:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"innovation-challenges:read", "innovation-challenges:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"innovation-challenges:read", "innovation-challenges:write"})
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"innovation-challenges:read", "innovation-challenges:write"})
     */
    private $participants;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"innovation-challenges:read", "innovation-challenges:write"})
     */
    private $status;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"innovation-challenges:read", "innovation-challenges:write"})
     */
    private $deadline;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"innovation-challenges:read", "innovation-challenges:write"})
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=InnovationChallengeCategories::class, mappedBy="innovation_challenge")
     * @Groups({"innovation-challenges:read", "innovation-challenges:write"})
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
