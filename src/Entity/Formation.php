<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 *  * @Vich\Uploadable
 */


class Formation
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomFormation;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $Datefin;

    /**
     * @ORM\Column(type="time")
     */
    private $horaire;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;
    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionFormation::class, mappedBy="formation", orphanRemoval=true)
     */
    private $inscriptionformation;



    /**
     * @ORM\ManyToMany(targetEntity=Session::class, inversedBy="formations")
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity=Administrateur::class, inversedBy="formations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $administrateurs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function __construct()
    {

        $this->inscriptionformation = new ArrayCollection();

        $this->session = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFormation(): ?string
    {
        return $this->NomFormation;
    }

    public function setNomFormation(string $NomFormation): self
    {
        $this->NomFormation = $NomFormation;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->DateDebut;
    }

    public function setDateDebut(\DateTimeInterface $DateDebut): self
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->Datefin;
    }

    public function setDatefin(\DateTimeInterface $Datefin): self
    {
        $this->Datefin = $Datefin;

        return $this;
    }

    public function getHoraire(): ?\DateTimeInterface
    {
        return $this->horaire;
    }

    public function setHoraire(\DateTimeInterface $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


    /**
     * @return Collection|InscriptionFormation[]
     */
    public function getInscriptionformation(): Collection
    {
        return $this->inscriptionformation;
    }

    public function addInscriptionformation(InscriptionFormation $inscriptionformation): self
    {
        if (!$this->inscriptionformation->contains($inscriptionformation)) {
            $this->inscriptionformation[] = $inscriptionformation;
            $inscriptionformation->setFormation($this);
        }

        return $this;
    }

    public function removeInscriptionformation(InscriptionFormation $inscriptionformation): self
    {
        if ($this->inscriptionformation->removeElement($inscriptionformation)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionformation->getFormation() === $this) {
                $inscriptionformation->setFormation(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Session[]
     */
    public function getSession(): Collection
    {
        return $this->session;
    }

    public function addSession(Session $session): self
    {
        if (!$this->session->contains($session)) {
            $this->session[] = $session;
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        $this->session->removeElement($session);

        return $this;
    }

    public function getAdministrateurs(): ?Administrateur
    {
        return $this->administrateurs;
    }

    public function setAdministrateurs(?Administrateur $administrateurs): self
    {
        $this->administrateurs = $administrateurs;

        return $this;
    }

    public function setImageFile( $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

}