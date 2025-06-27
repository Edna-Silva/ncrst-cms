<?php

namespace App\Entity;

use App\Repository\EcosystemPartnerExamplesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=EcosystemPartnerExamplesRepository::class)
 * normalizationContext={"groups"={"ecosystem-partner-examples:read"}},
 * denormalizationContext={"groups"={"ecosystem-partner-examples:write"}}
 * 
 */
class EcosystemPartnerExamples
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=EcosystemPartners::class, inversedBy="ecosystem_partner_examples")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ecosystem_partner;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $example;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEcosystemPartner(): ?EcosystemPartners
    {
        return $this->ecosystem_partner;
    }

    public function setEcosystemPartner(?EcosystemPartners $ecosystem_partner): self
    {
        $this->ecosystem_partner = $ecosystem_partner;

        return $this;
    }

    public function getExample(): ?string
    {
        return $this->example;
    }

    public function setExample(?string $example): self
    {
        $this->example = $example;

        return $this;
    }
}
