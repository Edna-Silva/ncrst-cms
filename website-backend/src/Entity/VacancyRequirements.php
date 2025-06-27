<?php

namespace App\Entity;

use App\Repository\VacancyRequirementsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VacancyRequirementsRepository::class)
 * normalizationContext={"groups"={"vacancy-requirements:read"}},
 * denormalizationContext={"groups"={"vacancy-requirements:write"}}
 */
class VacancyRequirements
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Vacancies::class, inversedBy="vacancyRequirements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vacancy;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $requirement;

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

    public function getRequirement(): ?string
    {
        return $this->requirement;
    }

    public function setRequirement(?string $requirement): self
    {
        $this->requirement = $requirement;

        return $this;
    }
}
