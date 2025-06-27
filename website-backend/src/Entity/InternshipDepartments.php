<?php

namespace App\Entity;

use App\Repository\InternshipDepartmentsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=InternshipDepartmentsRepository::class)
 * normalizationContext={"groups"={"internship-departments:read"}},
 * denormalizationContext={"groups"={"internship-departments:write"}}

 */
class InternshipDepartments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=InternshipPrograms::class, inversedBy="internship_department")
     * @ORM\JoinColumn(nullable=false)
     */
    private $internship_programs;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $department;

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

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }
}
