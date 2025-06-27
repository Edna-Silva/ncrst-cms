<?php

namespace App\Entity;

use App\Repository\InternshipBenefitsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=InternshipBenefitsRepository::class)
 * normalizationContext={"groups"={"internship-benefits:read"}},
 * denormalizationContext={"groups"={"internship-benefits:write"}}
 */
class InternshipBenefits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=InternshipPrograms::class, inversedBy="internship_benefits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $internship_programs;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $benefit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInternshipPrograms(): ?InternshipPrograms
    {
        return $this->internship_programs;
    }

    public function setInternshipPrograms(?InternshipPrograms $internship_programs): self
    {
        $this->internship_programs = $internship_programs;

        return $this;
    }

    public function getBenefit(): ?string
    {
        return $this->benefit;
    }

    public function setBenefit(?string $benefit): self
    {
        $this->benefit = $benefit;

        return $this;
    }
}
