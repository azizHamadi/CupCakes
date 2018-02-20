<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LineCmd
 *
 * @ORM\Table(name="line_cmd")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\LineCmdRepository")
 */
class LineCmd
{
    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Commande")
     * @ORM\Id
     * @ORM\JoinColumn(name="idCmd",referencedColumnName="idCmd")
     */
    private $idCmd;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Produit")
     * @ORM\Id
     * @ORM\JoinColumn(name="idProd",referencedColumnName="idProd")
     */
    private $idProd;

    /**
     * @var float
     *
     * @ORM\Column(name="qteAcheter", type="integer", nullable=true)
     */
    private $qteAcheter;

    /**
     * @var string
     *
     * @ORM\Column(name="etatLineCmd", type="string", length=255, nullable=true)
     */
    private $etatLineCmd="vrai";

    /**
     * Set qteAcheter
     *
     * @param float $qteAcheter
     *
     * @return LineCmd
     */
    public function setQteAcheter($qteAcheter)
    {
        $this->qteAcheter = $qteAcheter;
    
        return $this;
    }

    /**
     * Get qteAcheter
     *
     * @return float
     */
    public function getQteAcheter()
    {
        return $this->qteAcheter;
    }

    /**
     * Set etatLineCmd
     *
     * @param string $etatLineCmd
     *
     * @return LineCmd
     */
    public function setEtatLineCmd($etatLineCmd)
    {
        $this->etatLineCmd = $etatLineCmd;
    
        return $this;
    }

    /**
     * Get etatLineCmd
     *
     * @return string
     */
    public function getEtatLineCmd()
    {
        return $this->etatLineCmd;
    }

    /**
     * Set idCmd
     *
     * @param \CupCakesBundle\Entity\Commande $idCmd
     *
     * @return LineCmd
     */
    public function setIdCmd(\CupCakesBundle\Entity\Commande $idCmd = null)
    {
        $this->idCmd = $idCmd;
    
        return $this;
    }

    /**
     * Get idCmd
     *
     * @return \CupCakesBundle\Entity\Commande
     */
    public function getIdCmd()
    {
        return $this->idCmd;
    }

    /**
     * Set idProd
     *
     * @param \CupCakesBundle\Entity\Produit $idProd
     *
     * @return LineCmd
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
}
