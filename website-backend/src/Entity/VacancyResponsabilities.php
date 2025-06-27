<?php

namespace App\Entity;

use App\Repository\VacancyResponsabilitiesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=VacancyResponsabilitiesRepository::class)
 * normalizationContext={"groups"={"vacancy-responsibilities:read"}},
 * denormalizationContext={"groups"={"vacancy-responsibilities:write"}}
 */
class VacancyResponsabilities
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Vacancies::class, inversedBy="vacancyResponsabilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vacancy;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $responsability;

    /**
     * @ORM\Column(type="string", length=255)
     */

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
