<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\formationRepository")
 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFor", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nomFor", type="string", length=500, nullable=true)
     * @Assert\NotBlank(message="le nom est obligatoire")
     */
    private $nomFor;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=500, nullable=true)
     * @Assert\NotBlank(message="la place est obligatoire")
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="etatFor", type="string", length=255, nullable=true)
     */
    private $etatFor ="vrai";

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionFor", type="string", length=255, nullable=true)
     *
     *
     */
    private $descriptionFor;

    /**
     * Set dateFor
     *
     * @param \DateTime $dateFor
     *
     * @return Session
     */
    public function setDateFor($dateFor)
    {
        $this->dateFor = $dateFor;

        return $this;
    }

    /**
     * Get dateFor
     *
     * @return \DateTime
     */
    public function getDateFor()
    {
        return $this->dateFor;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFor", type="date", nullable=true)
     * @Assert\GreaterThan("today")
     *
     */
    private $dateFor;

    /**
     * @ORM\Column(name="imageform",type="string", length=10000, nullable=true)
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "image/jpeg","image/jpg","image/png","image/gif" })
     */
    private $imageForm;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\TypeFormation")
     *
     * @ORM\JoinColumn(name="idTypeFor",referencedColumnName="idTypeFor")
     */
    private $idTypeFor;

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
     * Set nomFor
     *
     * @param string $nomFor
     *
     * @return formation
     */
    public function setNomFor($nomFor)
    {
        $this->nomFor = $nomFor;

        return $this;
    }

    /**
     * Get nomFor
     *
     * @return string
     */
    public function getNomFor()
    {
        return $this->nomFor;
    }

    /**
     * Set etatFor
     *
     * @param string $etatFor
     *
     * @return formation
     */
    public function setEtatFor($etatFor)
    {
        $this->etatFor = $etatFor;

        return $this;
    }

    /**
     * Get etatFor
     *
     * @return string
     */
    public function getEtatFor()
    {
        return $this->etatFor;
    }

    /**
     * Set idUser
     *
     * @param \CupCakesBundle\Entity\User $idUser
     *
     * @return formation
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
     * Set idTypeFor
     *
     * @param \CupCakesBundle\Entity\TypeFormation $idTypeFor
     *
     * @return Formation
     */
    public function setIdTypeFor(\CupCakesBundle\Entity\TypeFormation $idTypeFor = null)
    {
        $this->idTypeFor = $idTypeFor;

        return $this;
    }

    /**
     * Get idTypeFor
     *
     * @return \CupCakesBundle\Entity\TypeFormation
     */
    public function getIdTypeFor()
    {
        return $this->idTypeFor;
    }

    /**
     * Set descriptionFor
     *
     * @param string $descriptionFor
     *
     * @return Formation
     */
    public function setDescriptionFor($descriptionFor)
    {
        $this->descriptionFor = $descriptionFor;

        return $this;
    }

    /**
     * Get descriptionFor
     *
     * @return string
     */
    public function getDescriptionFor()
    {
        return $this->descriptionFor;
    }

    /**
     * Set imageForm
     *
     * @param string $imageForm
     *
     * @return Formation
     */
    public function setImageForm($imageForm)
    {
        $this->imageForm = $imageForm;

        return $this;
    }

    /**
     * Get imageForm
     *
     * @return string
     */
    public function getImageForm()
    {
        return $this->imageForm;
    }


}
