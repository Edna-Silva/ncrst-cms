<?php

namespace App\Entity;

use App\Repository\IksIniativesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=IksIniativesRepository::class)
 * normalizationContext={"groups"={"iks-initiatives:read"}},
 * denormalizationContext={"groups"={"iks-initiatives:write"}}

 * 
 */
class IksIniatives
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $timeline;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $communities;

    /**
     * @ORM\OneToMany(targetEntity=IksIniativeOutcomes::class, mappedBy="iks_iniatives")
     */
    private $iks_iniative_outcomes;

    public function __construct()
    {
        $this->iks_iniative_outcomes = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTimeline(): ?string
    {
        return $this->timeline;
    }

    public function setTimeline(?string $timeline): self
    {
        $this->timeline = $timeline;

        return $this;
    }

    public function getCommunities(): ?string
    {
        return $this->communities;
    }

    public function setCommunities(?string $communities): self
    {
        $this->communities = $communities;

        return $this;
    }

    /**
     * @return Collection<int, IksIniativeOutcomes>
     */
    public function getIksIniativeOutcomes(): Collection
    {
        return $this->iks_iniative_outcomes;
    }

    public function addIksIniativeOutcome(IksIniativeOutcomes $iksIniativeOutcome): self
    {
        if (!$this->iks_iniative_outcomes->contains($iksIniativeOutcome)) {
            $this->iks_iniative_outcomes[] = $iksIniativeOutcome;
            $iksIniativeOutcome->setIksIniatives($this);
        }

        return $this;
    }

    public function removeIksIniativeOutcome(IksIniativeOutcomes $iksIniativeOutcome): self
    {
        if ($this->iks_iniative_outcomes->removeElement($iksIniativeOutcome)) {
            // set the owning side to null (unless already changed)
            if ($iksIniativeOutcome->getIksIniatives() === $this) {
                $iksIniativeOutcome->setIksIniatives(null);
            }
        }

        return $this;
    }
}
