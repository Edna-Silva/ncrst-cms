<?php

namespace App\Entity;

use App\Repository\InternshipProgramsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InternshipProgramsRepository::class)
 */
class InternshipPrograms
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
    private $title;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $intake;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eligibility;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $stipend;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=InternshipDepartments::class, mappedBy="internship_programs")
     */
    private $internship_department;

    /**
     * @ORM\OneToMany(targetEntity=InternshipBenefits::class, mappedBy="internship_programs")
     */
    private $internship_benefits;

    public function __construct()
    {
        $this->internship_department = new ArrayCollection();
        $this->internship_benefits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getIntake(): ?string
    {
        return $this->intake;
    }

    public function setIntake(?string $intake): self
    {
        $this->intake = $intake;

        return $this;
    }

    public function getEligibility(): ?string
    {
        return $this->eligibility;
    }

    public function setEligibility(?string $eligibility): self
    {
        $this->eligibility = $eligibility;

        return $this;
    }

    public function getStipend(): ?string
    {
        return $this->stipend;
    }

    public function setStipend(?string $stipend): self
    {
        $this->stipend = $stipend;

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
     * @return Collection<int, InternshipDepartments>
     */
    public function getInternshipDepartment(): Collection
    {
        return $this->internship_department;
    }

    public function addInternshipDepartment(InternshipDepartments $internshipDepartment): self
    {
        if (!$this->internship_department->contains($internshipDepartment)) {
            $this->internship_department[] = $internshipDepartment;
            $internshipDepartment->setInternshipPrograms($this);
        }

        return $this;
    }

    public function removeInternshipDepartment(InternshipDepartments $internshipDepartment): self
    {
        if ($this->internship_department->removeElement($internshipDepartment)) {
            // set the owning side to null (unless already changed)
            if ($internshipDepartment->getInternshipPrograms() === $this) {
                $internshipDepartment->setInternshipPrograms(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InternshipBenefits>
     */
    public function getInternshipBenefits(): Collection
    {
        return $this->internship_benefits;
    }

    public function addInternshipBenefit(InternshipBenefits $internshipBenefit): self
    {
        if (!$this->internship_benefits->contains($internshipBenefit)) {
            $this->internship_benefits[] = $internshipBenefit;
            $internshipBenefit->setInternshipPrograms($this);
        }

        return $this;
    }

    public function removeInternshipBenefit(InternshipBenefits $internshipBenefit): self
    {
        if ($this->internship_benefits->removeElement($internshipBenefit)) {
            // set the owning side to null (unless already changed)
            if ($internshipBenefit->getInternshipPrograms() === $this) {
                $internshipBenefit->setInternshipPrograms(null);
            }
        }

        return $this;
    }
}
