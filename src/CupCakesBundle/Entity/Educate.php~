<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * educate
 *
 * @ORM\Table(name="educate")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\educateRepository")
 */
class Educate
{

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\User")
     * @ORM\Id
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Session")
     * @ORM\Id
     * @ORM\JoinColumn(name="idSes",referencedColumnName="idSes")
     */
    private $idSes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateIscri", type="date", nullable=true)
     */
    private $dateIscri;

    /**
     * @var string
     *
     * @ORM\Column(name="etatEduc", type="string", length=255, nullable=true)
     */
    private $etatEduc;

    /**
     * Set dateIscri
     *
     * @param \DateTime $dateIscri
     *
     * @return educate
     */
    public function setDateIscri($dateIscri)
    {
        $this->dateIscri = $dateIscri;

        return $this;
    }

    /**
     * Get dateIscri
     *
     * @return \DateTime
     */
    public function getDateIscri()
    {
        return $this->dateIscri;
    }

    /**
     * Set etatEduc
     *
     * @param string $etatEduc
     *
     * @return educate
     */
    public function setEtatEduc($etatEduc)
    {
        $this->etatEduc = $etatEduc;

        return $this;
    }

    /**
     * Get etatEduc
     *
     * @return string
     */
    public function getEtatEduc()
    {
        return $this->etatEduc;
    }

    /**
     * Set idUser
     *
     * @param \CupCakesBundle\Entity\User $idUser
     *
     * @return Educate
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
     * Set idSes
     *
     * @param \CupCakesBundle\Entity\Session $idSes
     *
     * @return Educate
     */
    public function setIdSes(\CupCakesBundle\Entity\Session $idSes = null)
    {
        $this->idSes = $idSes;

        return $this;
    }

    /**
     * Get idSes
     *
     * @return \CupCakesBundle\Entity\Session
     */
    public function getIdSes()
    {
        return $this->idSes;
    }
}
