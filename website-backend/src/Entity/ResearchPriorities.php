<?php

namespace App\Entity;

use App\Repository\ResearchPrioritiesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ResearchPrioritiesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"research-priorities:read"}},
 *  denormalizationContext={"groups"={"research-priorities:write"}}
 * )
 */
class ResearchPriorities
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"research-priorities:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"research-priorities:read", "research-priorities:write"})
     */
    private $priority;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
}
