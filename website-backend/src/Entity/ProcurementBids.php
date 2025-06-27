<?php

namespace App\Entity;

use App\Repository\ProcurementBidsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=ProcurementBidsRepository::class)
 * @ApiResource(
 *   normalizationContext={"groups"={"procurement-bids:read"}},
 *   denormalizationContext={"groups"={"procurement-bids:write"}}
 * )
 */
class ProcurementBids
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"procurement-bids:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $reference;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $value;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $closing_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $publish_date;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $status;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $is_awarded;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $vendor;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $awarded_value;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $awarded_date;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $contract_period;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=ProcurementDocuments::class, mappedBy="procurement_bids")
     * @Groups({"procurement-bids:read", "procurement-bids:write"})
     */
    private $procurement_documents;

    public function __construct()
    {
        $this->procurement_documents = new ArrayCollection();
    }

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getClosingDate(): ?\DateTimeInterface
    {
        return $this->closing_date;
    }

    public function setClosingDate(?\DateTimeInterface $closing_date): self
    {
        $this->closing_date = $closing_date;

        return $this;
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publish_date;
    }

    public function setPublishDate(?\DateTimeInterface $publish_date): self
    {
        $this->publish_date = $publish_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function isIsAwarded(): ?bool
    {
        return $this->is_awarded;
    }

    public function setIsAwarded(?bool $is_awarded): self
    {
        $this->is_awarded = $is_awarded;

        return $this;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function setVendor(?string $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getAwardedValue(): ?string
    {
        return $this->awarded_value;
    }

    public function setAwardedValue(string $awarded_value): self
    {
        $this->awarded_value = $awarded_value;

        return $this;
    }

    public function getAwardedDate(): ?\DateTimeInterface
    {
        return $this->awarded_date;
    }

    public function setAwardedDate(?\DateTimeInterface $awarded_date): self
    {
        $this->awarded_date = $awarded_date;

        return $this;
    }

    public function getContractPeriod(): ?string
    {
        return $this->contract_period;
    }

    public function setContractPeriod(?string $contract_period): self
    {
        $this->contract_period = $contract_period;

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
     * @return Collection<int, ProcurementDocuments>
     */
    public function getProcurementDocuments(): Collection
    {
        return $this->procurement_documents;
    }

    public function addProcurementDocument(ProcurementDocuments $procurementDocument): self
    {
        if (!$this->procurement_documents->contains($procurementDocument)) {
            $this->procurement_documents[] = $procurementDocument;
            $procurementDocument->setProcurementBids($this);
        }

        return $this;
    }

    public function removeProcurementDocument(ProcurementDocuments $procurementDocument): self
    {
        if ($this->procurement_documents->removeElement($procurementDocument)) {
            // set the owning side to null (unless already changed)
            if ($procurementDocument->getProcurementBids() === $this) {
                $procurementDocument->setProcurementBids(null);
            }
        }

        return $this;
    }
}
