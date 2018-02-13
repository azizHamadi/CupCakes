<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeFormation
 *
 * @ORM\Table(name="type_formation")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\TypeFormationRepository")
 */
class TypeFormation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTypeFor", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTypeFor;

    /**
     * @var string
     *
     * @ORM\Column(name="nomTypeFor", type="string", length=255, nullable=true)
     */
    private $nomTypeFor;


    /**
     * Get idTypeFor
     *
     * @return int
     */
    public function getIdTypeFor()
    {
        return $this->idTypeFor;
    }

    /**
     * Set nomTypeFor
     *
     * @param string $nomTypeFor
     *
     * @return TypeFormation
     */
    public function setNomTypeFor($nomTypeFor)
    {
        $this->nomTypeFor = $nomTypeFor;

        return $this;
    }

    /**
     * Get nomTypeFor
     *
     * @return string
     */
    public function getNomTypeFor()
    {
        return $this->nomTypeFor;
    }
}
