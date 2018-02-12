<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LinePromo
 *
 * @ORM\Table(name="line_promo")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\LinePromoRepository")
 */
class LinePromo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeb", type="date", nullable=true)
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="etatLinePromo", type="string", length=255, nullable=true)
     */
    private $etatLinePromo;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Produit")
     *
     * @ORM\JoinColumn(name="idProd",referencedColumnName="idProd")
     */
    private $idProd;

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
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     *
     * @return LinePromo
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
     * @return LinePromo
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
     * Set etatLinePromo
     *
     * @param string $etatLinePromo
     *
     * @return LinePromo
     */
    public function setEtatLinePromo($etatLinePromo)
    {
        $this->etatLinePromo = $etatLinePromo;
    
        return $this;
    }

    /**
     * Get etatLinePromo
     *
     * @return string
     */
    public function getEtatLinePromo()
    {
        return $this->etatLinePromo;
    }

    /**
     * Set idProd
     *
     * @param \CupCakesBundle\Entity\Produit $idProd
     *
     * @return LinePromo
     */
    public function setIdProd(\CupCakesBundle\Entity\Produit $idProd = null)
    {
        $this->idProd = $idProd;
    
        return $this;
    }

    /**
     * Get idProd
     *
     * @return \CupCakesBundle\Entity\Produit
     */
    public function getIdProd()
    {
        return $this->idProd;
    }

    /**
     * Set idPromo
     *
     * @param \CupCakesBundle\Entity\Promotion $idPromo
     *
     * @return LinePromo
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
