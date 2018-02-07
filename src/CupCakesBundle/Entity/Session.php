<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $dateDebSes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinSes", type="date", nullable=true)
     */
    private $dateFinSes;

    /**
     * @var int
     *
     * @ORM\Column(name="capaciteSes", type="integer", nullable=true)
     */
    private $capaciteSes;

    /**
     * @var string
     *
     * @ORM\Column(name="etatSes", type="string", length=255, nullable=true)
     */
    private $etatSes;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Formation")
     *
     * @ORM\JoinColumn(name="idFor",referencedColumnName="idFor")
     */
    private $idFor;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Promotion")
     *
     * @ORM\JoinColumn(name="idPromo",referencedColumnName="idPromo")
     */
    private $idPromo;

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
     * Set idPromo
     *
     * @param \CupCakesBundle\Entity\Promotion $idPromo
     *
     * @return Session
     */
    public function setIdPromo(\CupCakesBundle\Entity\Promotion $idPromo = null)
    {
        $this->idPromo = $idPromo;
    
        return $this;
    }

    /**
     * Get idPromo
     *
     * @return \CupCakesBundle\Entity\Promotion
     */
    public function getIdPromo()
    {
        return $this->idPromo;
    }
}
