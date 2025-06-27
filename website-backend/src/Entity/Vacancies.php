<?php

namespace App\Entity;

use App\Repository\VacanciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=VacanciesRepository::class)
 * normalizationContext={"groups"={"vacancies:read"}},
 * denormalizationContext={"groups"={"vacancies:write"}}

 */
class Vacancies
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $department;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $closing_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $publish_date;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $salary;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\OneToMany(targetEntity=VacancyRequirements::class, mappedBy="vacancy")
     */
    private $vacancyRequirements;

    /**
     * @ORM\OneToMany(targetEntity=VacancyResponsabilities::class, mappedBy="vacancy")
     */
    private $vacancyResponsabilities;

    public function __construct()
    {
        $this->vacancyRequirements = new ArrayCollection();
        $this->vacancyResponsabilities = new ArrayCollection();
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

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getClosingDate(): ?\DateTimeInterface
    {
        return $this->closing_date;
    }

    public function setClosingDate(?\DateTimeInterface $closing_date): self
    {
        $this->closing_date = $closing_date;

        return $this;
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publish_date;
    }

    public function setPublishDate(?\DateTimeInterface $publish_date): self
    {
        $this->publish_date = $publish_date;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * @return Collection<int, VacancyRequirements>
     */
    public function getVacancyRequirements(): Collection
    {
        return $this->vacancyRequirements;
    }

    public function addVacancyRequirement(VacancyRequirements $vacancyRequirement): self
    {
        if (!$this->vacancyRequirements->contains($vacancyRequirement)) {
            $this->vacancyRequirements[] = $vacancyRequirement;
            $vacancyRequirement->setVacancy($this);
        }

        return $this;
    }

    public function removeVacancyRequirement(VacancyRequirements $vacancyRequirement): self
    {
        if ($this->vacancyRequirements->removeElement($vacancyRequirement)) {
            // set the owning side to null (unless already changed)
            if ($vacancyRequirement->getVacancy() === $this) {
                $vacancyRequirement->setVacancy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VacancyResponsabilities>
     */
    public function getVacancyResponsabilities(): Collection
    {
        return $this->vacancyResponsabilities;
    }

    public function addVacancyResponsability(VacancyResponsabilities $vacancyResponsability): self
    {
        if (!$this->vacancyResponsabilities->contains($vacancyResponsability)) {
            $this->vacancyResponsabilities[] = $vacancyResponsability;
            $vacancyResponsability->setVacancy($this);
        }

        return $this;
    }

    public function removeVacancyResponsability(VacancyResponsabilities $vacancyResponsability): self
    {
        if ($this->vacancyResponsabilities->removeElement($vacancyResponsability)) {
            // set the owning side to null (unless already changed)
            if ($vacancyResponsability->getVacancy() === $this) {
                $vacancyResponsability->setVacancy(null);
            }
        }

        return $this;
    }
}
