<?php

namespace App\Entity;

use App\Repository\IksCouncilMembersRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=IksCouncilMembersRepository::class)
 * 
 * @ApiResource(
 *  normalizationContext={"groups"={"iks-council-members:read"}},
 *  denormalizationContext={"groups"={"iks-council-members:write"}}
 * )
 */
class IksCouncilMembers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"iks-council-members:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"iks-council-members:read", "iks-council-members:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *  @Groups({"iks-council-members:read", "iks-council-members:write"})
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"iks-council-members:read", "iks-council-members:write"})
     */
    private $expertise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"iks-council-members:read", "iks-council-members:write"})
     */
    private $community;

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
