<?php

namespace CupCakesBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * CommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandeRepository extends EntityRepository
{
    public function findMax()
    {
        $query = $this->createQueryBuilder('e')
            ->select('e')
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(1)
;
        return $query->getQuery()->getOneOrNullResult();

    }
}
