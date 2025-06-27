<?php

namespace App\Entity;

use App\Repository\IksIniativeOutcomesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=IksIniativeOutcomesRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"iks-initiative-outcomes:read"}},
 * denormalizationContext={"groups"={"iks-initiative-outcomes:write"}}
 * )
 */
class IksIniativeOutcomes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"iks-initiative-outcomes:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=IksIniatives::class, inversedBy="iks_iniative_outcomes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"iks-initiative-outcomes:read", "iks-initiative-outcomes:write"})
     */
    private $iks_iniatives;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"iks-initiative-outcomes:read", "iks-initiative-outcomes:write"})
     * 
     */
    private $outcome;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIksIniatives(): ?IksIniatives
    {
        return $this->iks_iniatives;
    }

    public function setIksIniatives(?IksIniatives $iks_iniatives): self
    {
        $this->iks_iniatives = $iks_iniatives;

        return $this;
    }

    public function getOutcome(): ?string
    {
        return $this->outcome;
    }

    public function setOutcome(?string $outcome): self
    {
        $this->outcome = $outcome;

        return $this;
    }
}
