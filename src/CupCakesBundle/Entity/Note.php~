<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\NoteRepository")
 */
class Note
{
    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\User")
     * @ORM\Id
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Recette")
     * @ORM\Id
     * @ORM\JoinColumn(name="idRec",referencedColumnName="idRec")
     */
    private $idRec;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float", nullable=true)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNote", type="date", nullable=true)
     */
    private $dateNote;

    /**
     * @var string
     *
     * @ORM\Column(name="etatNote", type="string", length=255, nullable=true)
     */
    private $etatNote = "oui";


    /**
     * Set note
     *
     * @param float $note
     *
     * @return Note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set dateNote
     *
     * @param \DateTime $dateNote
     *
     * @return Note
     */
    public function setDateNote($dateNote)
    {
        $this->dateNote = $dateNote;

        return $this;
    }

    /**
     * Get dateNote
     *
     * @return \DateTime
     */
    public function getDateNote()
    {
        return $this->dateNote;
    }

    /**
     * Set etatNote
     *
     * @param string $etatNote
     *
     * @return Note
     */
    public function setEtatNote($etatNote)
    {
        $this->etatNote = $etatNote;

        return $this;
    }

    /**
     * Get etatNote
     *
     * @return string
     */
    public function getEtatNote()
    {
        return $this->etatNote;
    }

    /**
     * Set idUser
     *
     * @param \CupCakesBundle\Entity\User $idUser
     *
     * @return Note
     */
    public function setIdUser(\CupCakesBundle\Entity\User $idUser)
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
     * @return Note
     */
    public function setIdRec(\CupCakesBundle\Entity\Recette $idRec)
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
