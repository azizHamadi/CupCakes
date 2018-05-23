<?php
/**
 * Created by PhpStorm.
 * User: hamdi fathallah
 * Date: 2/27/2018
 * Time: 6:00 PM
 */

namespace CupCakesBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * LinePromoSes
 *
 * @ORM\Table(name="LinePromoSes")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\LinePromoSesRepository")
 */
class LinePromoSes
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLine", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idLine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeb", type="datetime", nullable=true)
     * @Assert\GreaterThan("today")
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime", nullable=true)
     * @Assert\GreaterThan("today")
     */
    private $dateFin;


    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Promotion")
     *
     * @ORM\JoinColumn(name="idPromo",referencedColumnName="idPromo")
     */
    private $idPromo;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Session")
     *
     * @ORM\JoinColumn(name="idSes",referencedColumnName="idSes")
     */
    private $idSes;

    /**
     * @var string
     *
     * @ORM\Column(name="etatLinePromosession", type="string", length=255, nullable=true)
     */
    private $etatLinePromoSess;

    /**
     * Get idLine
     *
     * @return integer
     */
    public function getIdLine()
    {
        return $this->idLine;
    }

    /**
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     *
     * @return LinePromoSes
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return LinePromoSes
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set idPromo
     *
     * @param \CupCakesBundle\Entity\Promotion $idPromo
     *
     * @return LinePromoSes
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





    /**
     * Set idSes
     *
     * @param \CupCakesBundle\Entity\Session $idSes
     *
     * @return LinePromoSes
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

    /**
     * Set etatLinePromoSess.
     *
     * @param string|null $etatLinePromoSess
     *
     * @return LinePromoSes
     */
    public function setEtatLinePromoSess($etatLinePromoSess = null)
    {
        $this->etatLinePromoSess = $etatLinePromoSess;

        return $this;
    }

    /**
     * Get etatLinePromoSess.
     *
     * @return string|null
     */
    public function getEtatLinePromoSess()
    {
        return $this->etatLinePromoSess;
    }
}
