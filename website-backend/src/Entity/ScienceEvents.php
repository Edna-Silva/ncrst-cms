<?php

namespace App\Entity;

use App\Repository\ScienceEventsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ScienceEventsRepository::class)
 * @ApiResource( 
 *  normalizationContext={"groups"={"science-events:read"}},
 *  denormalizationContext={"groups"={"science-events:write"}}
 * )

 */
class ScienceEvents
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"science-events:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"science-events:read", "science-events::write"})
     */
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"science-events:read", "science-events::write"})
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"science-events:read", "science-events::write"})
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"science-events:read", "science-events::write"})
     */
    private $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"science-events:read", "science-events::write"})
     */
    private $description;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

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
