<?php

namespace CupCakesBundle\Repository;

/**
 * LineCmdRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LineCmdRepository extends \Doctrine\ORM\EntityRepository
{
    public function findMaxid()
    {
        $query = $this->createQueryBuilder('e')
            ->select('e')
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(1)
        ;
        return $query->getQuery()->getOneOrNullResult();

    }

    public function findcomm($user){
        $query = $this->createQueryBuilder('lc')
            ->select('lc')
            ->from('CupCakesBundle:Commande','c')
            ->andWhere('c.id = lc.idCmd')
            ->andWhere('c.idUser = :user' )
            ->andWhere('c.etatCmd = \'vrai\'')
            ->setParameter(':user',$user);
        return $query->getQuery()->getResult();

    }

    public function Com($id){
        $query=$this->createQueryBuilder('lc')
            ->select('lc')
            ->where('lc.idCmd = :id')
            ->setParameter(':id',$id);
        return $query->getQuery()->getResult();
    }


}
