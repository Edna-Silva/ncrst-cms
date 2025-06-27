<?php

namespace App\Entity;

use App\Repository\ProcurementDocumentsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProcurementDocumentsRepository::class)
 * normalizationContext={"groups"={"procurement-documents:read"}},
 * denormalizationContext={"groups"={"procurement-documents:write"}}

 */
class ProcurementDocuments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ProcurementBids::class, inversedBy="procurement_documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $procurement_bids;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $document_name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProcurementBids(): ?ProcurementBids
    {
        return $this->procurement_bids;
    }

    public function setProcurementBids(?ProcurementBids $procurement_bids): self
    {
        $this->procurement_bids = $procurement_bids;

        return $this;
    }

    public function getDocumentName(): ?string
    {
        return $this->document_name;
    }

    public function setDocumentName(?string $document_name): self
    {
        $this->document_name = $document_name;

        return $this;
    }
}
