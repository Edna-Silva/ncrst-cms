<?php

namespace App\Entity;

use App\Repository\CouncilMembersRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CouncilMembersRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"council-members:read"}},
 *  denormalizationContext={"groups"={"council-members:write"}}
 * )
 */
class CouncilMembers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"council-members:read"})

     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Councils::class, inversedBy="council_members")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"council-members:read", "council-members:write"})

     */
    private $council;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"council-members:read", "council-members:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"council-members:read", "council-members:write"})
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"council-members:read", "council-members:write"})
     */
    private $expertise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"council-members:read", "council-members:write"})
     */
    private $institution;

    /**
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"council-members:read", "council-members:write"})
     */
    private $community;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouncil(): ?Councils
    {
        return $this->council;
    }

    public function setCouncil(?Councils $council): self
    {
        $this->council = $council;

        return $this;
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getExpertise(): ?string
    {
        return $this->expertise;
    }

    public function setExpertise(?string $expertise): self
    {
        $this->expertise = $expertise;

        return $this;
    }

    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    public function setInstitution(?string $institution): self
    {
        $this->institution = $institution;

        return $this;
    }

    public function getCommunity(): ?string
    {
        return $this->community;
    }

    public function setCommunity(?string $community): self
    {
        $this->community = $community;

        return $this;
    }
}
