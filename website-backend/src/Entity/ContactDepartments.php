<?php

namespace App\Entity;

use App\Repository\ContactDepartmentsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ContactDepartmentsRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"contact_departments:read"}},
 *     denormalizationContext={"groups"={"contact_departments:write"}}
 * )
 */
class ContactDepartments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"contact_departments:read"})

     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"contact_departments:read", "contact_departments:write"})

     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"contact_departments:read", "contact_departments:write"})

     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"contact_departments:read", "contact_departments:write"})

     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"contact_departments:read", "contact_departments:write"})

     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

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
}
