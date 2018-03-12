<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Range;
//use Symfony\Component\Validator\Constraints\Re;



/**
 * Session
 *
 * @ORM\Table(name="session")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\SessionRepository")
 */
class Session
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSes", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebSes", type="date", nullable=true)
     *
     * @Assert\GreaterThan("today")
     */
    private $dateDebSes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinSes", type="date", nullable=true)

     *
     */
    private $dateFinSes;

    /**
     * @var int
     *
     * @ORM\Column(name="capaciteSes", type="integer", nullable=true)
     *
     * @Assert\GreaterThan(value="0",message="la capacite doit est superieur a 0")
     */
    private $capaciteSes;

    /**
     * @var string
     *
     * @ORM\Column(name="etatSes", type="string", length=255, nullable=true)
     */
    private $etatSes="en cours";


    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Formation")
     *
     * @ORM\JoinColumn(name="idFor",referencedColumnName="idFor")
     */
    private $idFor;



    /**
     * @ORM\Column(name="imagesess",type="string", length=10000, nullable=true)
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "image/jpeg","image/jpg","image/png","image/gif"})
     */
    private $imageSess;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateDebSes
     *
     * @param \DateTime $dateDebSes
     *
     * @return Session
     */
    public function setDateDebSes($dateDebSes)
    {
        $this->dateDebSes = $dateDebSes;

        return $this;
    }

    /**
     * Get dateDebSes
     *
     * @return \DateTime
     */
    public function getDateDebSes()
    {
        return $this->dateDebSes;
    }

    /**
     * Set dateFinSes
     *
     * @param \DateTime $dateFinSes
     *
     * @return Session
     */
    public function setDateFinSes($dateFinSes)
    {
        $this->dateFinSes = $dateFinSes;

        return $this;
    }

    /**
     * Get dateFinSes
     *
     * @return \DateTime
     */
    public function getDateFinSes()
    {
        return $this->dateFinSes;
    }

    /**
     * Set capaciteSes
     *
     * @param integer $capaciteSes
     *
     * @return Session
     */
    public function setCapaciteSes($capaciteSes)
    {
        $this->capaciteSes = $capaciteSes;

        return $this;
    }

    /**
     * Get capaciteSes
     *
     * @return integer
     */
    public function getCapaciteSes()
    {
        return $this->capaciteSes;
    }

    /**
     * Set etatSes
     *
     * @param string $etatSes
     *
     * @return Session
     */
    public function setEtatSes($etatSes)
    {
        $this->etatSes = $etatSes;

        return $this;
    }

    /**
     * Get etatSes
     *
     * @return string
     */
    public function getEtatSes()
    {
        return $this->etatSes;
    }

    /**
     * Set idFor
     *
     * @param \CupCakesBundle\Entity\Formation $idFor
     *
     * @return Session
     */
    public function setIdFor(\CupCakesBundle\Entity\Formation $idFor = null)
    {
        $this->idFor = $idFor;

        return $this;
    }

    /**
     * Get idFor
     *
     * @return \CupCakesBundle\Entity\Formation
     */
    public function getIdFor()
    {
        return $this->idFor;
    }


    /**
     * Set imageSess
     *
     * @param string $imageSess
     *
     * @return Session
     */
    public function setImageSess($imageSess)
    {
        $this->imageSess = $imageSess;

        return $this;
    }

    /**
     * Get imageSess
     *
     * @return string
     */
    public function getImageSess()
    {
        return $this->imageSess;
    }

    /**
     * @var float
     *
     * @ORM\Column(name="prix_ses", type="float", nullable=true)
     */
    private $prix;

    /**
     * @var float
     *
     * @ORM\Column(name="nv_prix_ses", type="float", nullable=true)
     */
    private $nv_prix = null;

    /**
     * @var string
     *
     * @ORM\Column(name="nomSes", type="string", length=500, nullable=true)
     */
    private $nomSes;

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Session
     */
    public function setPrix($prix)
    {
        $this->prixSes = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set nvPrix
     *
     * @param float $nvPrix
     *
     * @return Session
     */
    public function setNvPrix($nvPrix)
    {
        $this->nv_prixSes = $nvPrix;

        return $this;
    }

    /**
     * Get nvPrix
     *
     * @return float
     */
    public function getNvPrix()
    {
        return $this->nv_prix;
    }

    /**
     * Set nomSes
     *
     * @param string $nomSes
     *
     * @return Session
     */
    public function setNomSes($nomSes)
    {
        $this->nomSes = $nomSes;

        return $this;
    }

    /**
     * Get nomSes
     *
     * @return string
     */
    public function getNomSes()
    {
        return $this->nomSes;
    }
}
