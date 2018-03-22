<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 06/04/2017
 * Time: 17:36
 */

namespace SocialPro\NetworkBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProjetsRepository extends \Doctrine\ORM\EntityRepository
{
    public function nbF()
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.idPo)')
            ->where('p.progression = 100')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function nbD()
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.idPo)')
            ->where('p.progression = 0')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function nbE()
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.idPo)')
            ->where('p.progression != 0' )
            ->andWhere('p.progression != 100' )
            ->getQuery()
            ->getSingleScalarResult();
    }
   public function rechercheProjets($chaine)
    {
         $qb = $this->createQueryBuilder('u')
                    ->select('u')
                    ->where('u.name like :chaine')
                    ->orderBy('u.idPo')
                    ->setParameter('chaine', '%'. $chaine.'%');
        return $qb->getQuery()->getResult();
    }

}