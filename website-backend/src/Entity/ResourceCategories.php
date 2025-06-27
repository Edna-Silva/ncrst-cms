<?php

namespace App\Entity;

use App\Repository\ResourceCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ResourceCategoriesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"resource-categories:read"}},
 *  denormalizationContext={"groups"={"resource-categories:write"}}
 * )
 */
class ResourceCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"resource-categories:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * 
     * @Groups({"resource-categories:read", "resource-categories:write"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Resources::class, mappedBy="resource_categories")
     * @Groups({"resource-categories:read", "resource-categories:write"})
     */
    private $resources;

    public function __construct()
    {
        $this->resources = new ArrayCollection();
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

    /**
     * @return Collection<int, Resources>
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resources $resource): self
    {
        if (!$this->resources->contains($resource)) {
            $this->resources[] = $resource;
            $resource->setResourceCategories($this);
        }

        return $this;
    }

    public function removeResource(Resources $resource): self
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getResourceCategories() === $this) {
                $resource->setResourceCategories(null);
            }
        }

        return $this;
    }
}
