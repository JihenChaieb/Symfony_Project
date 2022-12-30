<?php

namespace App\Entity;

use App\Entity\User1;
use App\Repository\CondidatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CondidatRepository::class)
 */
class Condidat extends User1
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionFormation::class, mappedBy="candidat", orphanRemoval=true)
     */
    private $inscriptionFormations;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="condidats")
     */
    private $formateur;

    public function __construct()
    {
        $this->inscriptionFormations = new ArrayCollection();
        $this->formateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|InscriptionFormation[]
     */
    public function getInscriptionFormations(): Collection
    {
        return $this->inscriptionFormations;
    }

    public function addInscriptionFormation(InscriptionFormation $inscriptionFormation): self
    {
        if (!$this->inscriptionFormations->contains($inscriptionFormation)) {
            $this->inscriptionFormations[] = $inscriptionFormation;
            $inscriptionFormation->setCandidat($this);
        }

        return $this;
    }

    public function removeInscriptionFormation(InscriptionFormation $inscriptionFormation): self
    {
        if ($this->inscriptionFormations->removeElement($inscriptionFormation)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionFormation->getCandidat() === $this) {
                $inscriptionFormation->setCandidat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formateur[]
     */
    public function getFormateur(): Collection
    {
        return $this->formateur;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateur->contains($formateur)) {
            $this->formateur[] = $formateur;
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        $this->formateur->removeElement($formateur);

        return $this;
    }
}
