<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\recetteRepository")
 */
class Recette
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRec", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomRec", type="string", length=255, nullable=true)
     */
    private $nomRec;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRec", type="date", nullable=true)
     */
    private $dateRec ;

    /**
     * @var string
     *
     * @ORM\Column(name="etatRec", type="string", length=255, nullable=true)
     */
    private $etatRec = "oui";

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionRec", type="string", length=10000, nullable=true)
     */
    private $descriptionRec ;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\CategorieRec")
     *
     * @ORM\JoinColumn(name="idCatRec",referencedColumnName="idCatRec")
     */
    private $idCatRec;


    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\Column(name="imageRec",type="string", length=10000, nullable=true)
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $imageRec;

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
     * Set nomRec
     *
     * @param string $nomRec
     *
     * @return recette
     */
    public function setNomRec($nomRec)
    {
        $this->nomRec = $nomRec;

        return $this;
    }

    /**
     * Get nomRec
     *
     * @return string
     */
    public function getNomRec()
    {
        return $this->nomRec;
    }

    /**
     * Set dateRec
     *
     * @param \DateTime $dateRec
     *
     * @return recette
     */
    public function setDateRec($dateRec)
    {
        $this->dateRec = $dateRec;

        return $this;
    }

    /**
     * Get dateRec
     *
     * @return \DateTime
     */
    public function getDateRec()
    {
        return $this->dateRec;
    }

    /**
     * Set etatRec
     *
     * @param string $etatRec
     *
     * @return recette
     */
    public function setEtatRec($etatRec)
    {
        $this->etatRec = $etatRec;

        return $this;
    }

    /**
     * Get etatRec
     *
     * @return string
     */
    public function getEtatRec()
    {
        return $this->etatRec;
    }

    /**
     * Set idUser
     *
     * @param \CupCakesBundle\Entity\User $idUser
     *
     * @return Recette
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
     * Set idCatRec
     *
     * @param \CupCakesBundle\Entity\CategorieRec $idCatRec
     *
     * @return Recette
     */
    public function setIdCatRec(\CupCakesBundle\Entity\CategorieRec $idCatRec = null)
    {
        $this->idCatRec = $idCatRec;

        return $this;
    }

    /**
     * Get idCatRec
     *
     * @return \CupCakesBundle\Entity\CategorieRec
     */
    public function getIdCatRec()
    {
        return $this->idCatRec;
    }

    /**
     * Set descriptionRec
     *
     * @param string $descriptionRec
     *
     * @return Recette
     */
    public function setDescriptionRec($descriptionRec)
    {
        $this->descriptionRec = $descriptionRec;

        return $this;
    }

    /**
     * Get descriptionRec
     *
     * @return string
     */
    public function getDescriptionRec()
    {
        return $this->descriptionRec;
    }

    /**
     * Set imageRec
     *
     * @param string $imageRec
     *
     * @return Recette
     */
    public function setImageRec($imageRec)
    {
        $this->imageRec = $imageRec;

        return $this;
    }

    /**
     * Get imageRec
     *
     * @return string
     */
    public function getImageRec()
    {
        return $this->imageRec;
    }

}
