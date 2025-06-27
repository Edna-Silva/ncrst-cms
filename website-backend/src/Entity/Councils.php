<?php

namespace App\Entity;

use App\Repository\CouncilsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CouncilsRepository::class)
 * normalizationContext={"groups"={"councils:read"}},
 * denormalizationContext={"groups"={"councils:write"}}
 */
class Councils
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $members_count;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $link;

    /**
     * @ORM\OneToMany(targetEntity=CouncilMembers::class, mappedBy="council")
     */
    private $council_members;

    public function __construct()
    {
        $this->council_members = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getMembersCount(): ?int
    {
        return $this->members_count;
    }

    public function setMembersCount(?int $members_count): self
    {
        $this->members_count = $members_count;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection<int, CouncilMembers>
     */
    public function getCouncilMembers(): Collection
    {
        return $this->council_members;
    }

    public function addCouncilMember(CouncilMembers $councilMember): self
    {
        if (!$this->council_members->contains($councilMember)) {
            $this->council_members[] = $councilMember;
            $councilMember->setCouncil($this);
        }

        return $this;
    }

    public function removeCouncilMember(CouncilMembers $councilMember): self
    {
        if ($this->council_members->removeElement($councilMember)) {
            // set the owning side to null (unless already changed)
            if ($councilMember->getCouncil() === $this) {
                $councilMember->setCouncil(null);
            }
        }

        return $this;
    }
}
