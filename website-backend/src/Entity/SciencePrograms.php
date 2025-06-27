<?php

namespace App\Entity;

use App\Repository\ScienceProgramsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ScienceProgramsRepository::class)
 *  @ApiResource(
 *  normalizationContext={"groups"={"science-programs:read"}},
 *  denormalizationContext={"groups"={"science-programs:write"}}
 * )
 */
class SciencePrograms
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"science-programs:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"science-programs:read", "science-programs:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"science-programs:read", "science-programs:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"science-programs:read", "science-programs:write"})
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"science-programs:read", "science-programs:write"})
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"science-programs:read", "science-programs:write"})
     */
    private $link;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

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
}
