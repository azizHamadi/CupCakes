<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCmd", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCmd", type="date", nullable=true)
     */
    private $dateCmd;

    /**
     * @var float
     *
     * @ORM\Column(name="montantCmd", type="float", nullable=true)
     */
    private $montantCmd;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateLivCmd", type="date", nullable=true)
     * @Assert\GreaterThan("today")
     */
    private $dateLivCmd;

    /**
     * @var string
     *
     * @ORM\Column(name="addLiv", type="string", length=255, nullable=true)
     */
    private $adresseLi;

    /**
     * @var string
     *
     * @ORM\Column(name="etatLivCmd", type="string", length=255, nullable=true)
     */
    private $etatLivCmd="en cour";

    /**
     * @var string
     *
     * @ORM\Column(name="etatCmd", type="string", length=255, nullable=true)
     */
    private $etatCmd="vrai";

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;

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
     * Set dateCmd
     *
     * @param \DateTime $dateCmd
     *
     * @return Commande
     */
    public function setDateCmd($dateCmd)
    {
        $this->dateCmd = $dateCmd;
    
        return $this;
    }


    /**
     * Get dateCmd
     *
     * @return \DateTime
     */
    public function getDateCmd()
    {
        return $this->dateCmd;
    }

    /**
     * Set montantCmd
     *
     * @param float $montantCmd
     *
     * @return Commande
     */
    public function setMontantCmd($montantCmd)
    {
        $this->montantCmd = $montantCmd;
    
        return $this;
    }

    /**
     * Get montantCmd
     *
     * @return float
     */
    public function getMontantCmd()
    {
        return $this->montantCmd;
    }

    /**
     * Set dateLivCmd
     *
     * @param \DateTime $dateLivCmd
     *
     * @return Commande
     */
    public function setDateLivCmd($dateLivCmd)
    {
        $this->dateLivCmd = $dateLivCmd;
    
        return $this;
    }

    /**
     * Get dateLivCmd
     *
     * @return \DateTime
     */
    public function getDateLivCmd()
    {
        return $this->dateLivCmd;
    }

    /**
     * Set etatLivCmd
     *
     * @param string $etatLivCmd
     *
     * @return Commande
     */
    public function setEtatLivCmd($etatLivCmd)
    {
        $this->etatLivCmd = $etatLivCmd;
    
        return $this;
    }

    /**
     * Get etatLivCmd
     *
     * @return string
     */
    public function getEtatLivCmd()
    {
        return $this->etatLivCmd;
    }

    /**
     * Set etatCmd
     *
     * @param string $etatCmd
     *
     * @return Commande
     */
    public function setEtatCmd($etatCmd)
    {
        $this->etatCmd = $etatCmd;
    
        return $this;
    }

    /**
     * Get etatCmd
     *
     * @return string
     */
    public function getEtatCmd()
    {
        return $this->etatCmd;
    }

    /**
     * Set idUser
     *
     * @param \CupCakesBundle\Entity\User $idUser
     *
     * @return Commande
     */
    public function setIdUser(\CupCakesBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;
    
        return $this;
    }

    /**
     * Get idUser
     *
     * @return \CupCakesBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @return string
     */
    public function getAdresseLi()
    {
        return $this->adresseLi;
    }

    /**
     * @param string $adresseLi
     */
    public function setAdresseLi($adresseLi)
    {
        $this->adresseLi = $adresseLi;
    }

}
