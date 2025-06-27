<?php

namespace App\Entity;

use App\Repository\AiInitiativesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=AiInitiativesRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"ai_initiative:read"}},
 *     denormalizationContext={"groups"={"ai_initiative:write"}}
 * )
 */
class AiInitiatives
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ai_initiative:read"})
     */
    
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ai_initiative:read", "ai_initiative:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     *  @Groups({"ai_initiative:read", "ai_initiative:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *  @Groups({"ai_initiative:read", "ai_initiative:write"})
     */
    private $participants;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *  @Groups({"ai_initiative:read", "ai_initiative:write"})
     */
    private $projects;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getParticipants(): ?string
    {
        return $this->participants;
    }

    public function setParticipants(?string $participants): self
    {
        $this->participants = $participants;

        return $this;
    }

    public function getProjects(): ?string
    {
        return $this->projects;
    }

    public function setProjects(?string $projects): self
    {
        $this->projects = $projects;

        return $this;
    }
}
