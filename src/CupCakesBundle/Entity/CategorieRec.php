<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieRec
 *
 * @ORM\Table(name="categorie_rec")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\CategorieRecRepository")
 */
class CategorieRec
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCatRec", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCatRec;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCatRec", type="string", length=255, nullable=true)
     */
    private $nomCatRec;


    /**
     * Get idCatRec
     *
     * @return int
     */
    public function getIdCatRec()
    {
        return $this->idCatRec;
    }

    /**
     * Set nomCatRec
     *
     * @param string $nomCatRec
     *
     * @return CategorieRec
     */
    public function setNomCatRec($nomCatRec)
    {
        $this->nomCatRec = $nomCatRec;

        return $this;
    }

    /**
     * Get nomCatRec
     *
     * @return string
     */
    public function getNomCatRec()
    {
        return $this->nomCatRec;
    }
}
