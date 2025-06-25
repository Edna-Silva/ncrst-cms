<?php

namespace App\Entity;

use App\Repository\BoardCommissionerCommitteesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BoardCommissionerCommitteesRepository::class)
 */
class BoardCommissionerCommittees
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=BoardCommissioners::class, inversedBy="board_commisioner_committees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $board_commissioner;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $committee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBoardCommissioner(): ?BoardCommissioners
    {
        return $this->board_commissioner;
    }

    public function setBoardCommissioner(?BoardCommissioners $board_commissioner): self
    {
        $this->board_commissioner = $board_commissioner;

        return $this;
    }

    public function getCommittee(): ?string
    {
        return $this->committee;
    }

    public function setCommittee(?string $committee): self
    {
        $this->committee = $committee;

        return $this;
    }
}
