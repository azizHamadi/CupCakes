<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCmnt", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionCmnt", type="string", length=10000, nullable=true)
     */
    private $descriptionCmnt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCmnt", type="date", nullable=true)
     */
    private $dateCmnt;

    /**
     * @var string
     *
     * @ORM\Column(name="etatCmnt", type="string", length=255, nullable=true)
     */
    private $etatCmnt;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Recette")
     *
     * @ORM\JoinColumn(name="idRec",referencedColumnName="idRec")
     */
    private $idRec;

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
     * Set descriptionCmnt
     *
     * @param string $descriptionCmnt
     *
     * @return Commentaire
     */
    public function setDescriptionCmnt($descriptionCmnt)
    {
        $this->descriptionCmnt = $descriptionCmnt;
    
        return $this;
    }

    /**
     * Get descriptionCmnt
     *
     * @return string
     */
    public function getDescriptionCmnt()
    {
        return $this->descriptionCmnt;
    }

    /**
     * Set dateCmnt
     *
     * @param \DateTime $dateCmnt
     *
     * @return Commentaire
     */
    public function setDateCmnt($dateCmnt)
    {
        $this->dateCmnt = $dateCmnt;
    
        return $this;
    }

    /**
     * Get dateCmnt
     *
     * @return \DateTime
     */
    public function getDateCmnt()
    {
        return $this->dateCmnt;
    }

    /**
     * Set etatCmnt
     *
     * @param string $etatCmnt
     *
     * @return Commentaire
     */
    public function setEtatCmnt($etatCmnt)
    {
        $this->etatCmnt = $etatCmnt;
    
        return $this;
    }

    /**
     * Get etatCmnt
     *
     * @return string
     */
    public function getEtatCmnt()
    {
        return $this->etatCmnt;
    }

    /**
     * Set idUser
     *
     * @param \CupCakesBundle\Entity\User $idUser
     *
     * @return Commentaire
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
     * Set idRec
     *
     * @param \CupCakesBundle\Entity\Recette $idRec
     *
     * @return Commentaire
     */
    public function setIdRec(\CupCakesBundle\Entity\Recette $idRec = null)
    {
        $this->idRec = $idRec;
    
        return $this;
    }

    /**
     * Get idRec
     *
     * @return \CupCakesBundle\Entity\Recette
     */
    public function getIdRec()
    {
        return $this->idRec;
    }
}
