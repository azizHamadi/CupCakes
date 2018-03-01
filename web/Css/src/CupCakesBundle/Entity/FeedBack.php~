<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeedBack
 *
 * @ORM\Table(name="feed_back")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\FeedBackRepository")
 */
class FeedBack
{
    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Commande")
     * @ORM\Id
     * @ORM\JoinColumn(name="idCmd",referencedColumnName="idCmd")
     */
    private $idCmd;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=1000, nullable=true)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=10000, nullable=true)
     */
    private $description;

    /**
     * Set sujet
     *
     * @param string $sujet
     *
     * @return FeedBack
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    
        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return FeedBack
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set idCmd
     *
     * @param \CupCakesBundle\Entity\Commande $idCmd
     *
     * @return FeedBack
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
}
