<?php

namespace App\Entity;

use App\Repository\BoardCommissionersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BoardCommissionersRepository::class)
 */
class BoardCommissioners
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
     * @ORM\Column(type="string", length=100)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $expertise;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=BoardCommissionerCommittees::class, mappedBy="board_commissioner")
     */
    private $board_commisioner_committees;

    public function __construct()
    {
        $this->board_commisioner_committees = new ArrayCollection();
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
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
     * @return Collection<int, BoardCommissionerCommittees>
     */
    public function getBoardCommisionerCommittees(): Collection
    {
        return $this->board_commisioner_committees;
    }

    public function addBoardCommisionerCommittee(BoardCommissionerCommittees $boardCommisionerCommittee): self
    {
        if (!$this->board_commisioner_committees->contains($boardCommisionerCommittee)) {
            $this->board_commisioner_committees[] = $boardCommisionerCommittee;
            $boardCommisionerCommittee->setBoardCommissioner($this);
        }

        return $this;
    }

    public function removeBoardCommisionerCommittee(BoardCommissionerCommittees $boardCommisionerCommittee): self
    {
        if ($this->board_commisioner_committees->removeElement($boardCommisionerCommittee)) {
            // set the owning side to null (unless already changed)
            if ($boardCommisionerCommittee->getBoardCommissioner() === $this) {
                $boardCommisionerCommittee->setBoardCommissioner(null);
            }
        }

        return $this;
    }
}
