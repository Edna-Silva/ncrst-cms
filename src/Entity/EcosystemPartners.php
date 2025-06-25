<?php

namespace App\Entity;

use App\Repository\EcosystemPartnersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EcosystemPartnersRepository::class)
 */
class EcosystemPartners
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partner_count;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=EcosystemPartnerExamples::class, mappedBy="ecosystem_partner")
     */
    private $ecosystem_partner_examples;

    public function __construct()
    {
        $this->ecosystem_partner_examples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPartnerCount(): ?int
    {
        return $this->partner_count;
    }

    public function setPartnerCount(?int $partner_count): self
    {
        $this->partner_count = $partner_count;

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

    /**
     * @return Collection<int, EcosystemPartnerExamples>
     */
    public function getEcosystemPartnerExamples(): Collection
    {
        return $this->ecosystem_partner_examples;
    }

    public function addEcosystemPartnerExample(EcosystemPartnerExamples $ecosystemPartnerExample): self
    {
        if (!$this->ecosystem_partner_examples->contains($ecosystemPartnerExample)) {
            $this->ecosystem_partner_examples[] = $ecosystemPartnerExample;
            $ecosystemPartnerExample->setEcosystemPartner($this);
        }

        return $this;
    }

    public function removeEcosystemPartnerExample(EcosystemPartnerExamples $ecosystemPartnerExample): self
    {
        if ($this->ecosystem_partner_examples->removeElement($ecosystemPartnerExample)) {
            // set the owning side to null (unless already changed)
            if ($ecosystemPartnerExample->getEcosystemPartner() === $this) {
                $ecosystemPartnerExample->setEcosystemPartner(null);
            }
        }

        return $this;
    }
}
