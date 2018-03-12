<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * promotion
 *
 * @ORM\Table(name="promotion")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\promotionRepository")
 */
class Promotion
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPromo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="tauxPromo", type="float", nullable=true)
     */
    private $tauxPromo;

    /**
     * @var string
     *
     * @ORM\Column(name="etatPromo", type="string", length=255, nullable=true)
     */
    private $etatPromo;


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
     * Set tauxPromo
     *
     * @param float $tauxPromo
     *
     * @return promotion
     */
    public function setTauxPromo($tauxPromo)
    {
        $this->tauxPromo = $tauxPromo;

        return $this;
    }

    /**
     * Get tauxPromo
     *
     * @return float
     */
    public function getTauxPromo()
    {
        return $this->tauxPromo;
    }

    /**
     * Set etatPromo
     *
     * @param string $etatPromo
     *
     * @return promotion
     */
    public function setEtatPromo($etatPromo)
    {
        $this->etatPromo = $etatPromo;

        return $this;
    }

    /**
     * Get etatPromo
     *
     * @return string
     */
    public function getEtatPromo()
    {
        return $this->etatPromo;
    }
}
