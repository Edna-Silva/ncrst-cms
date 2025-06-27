<?php

namespace App\Entity;

use App\Repository\VacancyResponsabilitiesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VacancyResponsabilitiesRepository::class)
 * @ApiResource(
 *   normalizationContext={"groups"={"vacancy-responsibilities:read"}},
 *   denormalizationContext={"groups"={"vacancy-responsibilities:write"}}
 * )
 */
class VacancyResponsabilities
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"vacancy-responsibilities:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Vacancies::class, inversedBy="vacancyResponsabilities")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"vacancy-responsibilities:read", "vacancy-responsibilities:write"})
     */
    private $vacancy;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"vacancy-responsibilities:read", "vacancy-responsibilities:write"})
     */
    private $responsability;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVacancy(): ?Vacancies
    {
        return $this->vacancy;
    }

    public function setVacancy(?Vacancies $vacancy): self
    {
        $this->vacancy = $vacancy;

        return $this;
    }

    public function getResponsability(): ?string
    {
        return $this->responsability;
    }

    public function setResponsability(?string $responsability): self
    {
        $this->responsability = $responsability;

        return $this;
    }
}