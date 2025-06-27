<?php

namespace App\Entity;

use App\Repository\BoardCommissionerCommitteesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BoardCommissionerCommitteesRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"board_commissioner_committees:read"}},
 *     denormalizationContext={"groups"={"board_commissioner_committees:write"}}
 * )
 */
class BoardCommissionerCommittees
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"board_commissioner_committees:read"})

     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=BoardCommissioners::class, inversedBy="board_commisioner_committees")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"board_commissioner_committees:read", "board_commissioner_committees:write"})
     */
    private $board_commissioner;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"board_commissioner_committees:read", "board_commissioner_committees:write"})

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
