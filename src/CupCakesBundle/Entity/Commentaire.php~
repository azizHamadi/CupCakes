<?php

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="CupCakesBundle\Repository\CommentaireRepository")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Commentaire extends BaseComment implements SignedCommentInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCmnt", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\Thread")
     * @ORM\JoinColumn(name="idRec",referencedColumnName="id")
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="CupCakesBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    protected $idUser;

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
     * Set idUser
     *
     * @param \CupCakesBundle\Entity\User $idUser
     *
     * @return Commentaire
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
     * Sets the author of the Comment
     *
     * @param UserInterface $idUser
     */
    public function setAuthor(UserInterface $idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * Gets the author of the Comment
     *
     * @return UserInterface
     */
    public function getAuthor()
    {
        return $this->idUser;
    }

    public function getAuthorName()
    {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }

        return $this->getAuthor()->getUsername();
    }

}
