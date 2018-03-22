<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 09/04/2017
 * Time: 19:14
 */

namespace SocialPro\NetworkBundle\Repository;


class UsersRepository extends \Doctrine\ORM\EntityRepository
{
    public function userStatut($chaine)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.status like :chaine')
            ->orderBy('u.id')
            ->setParameter('chaine', '%'. $chaine.'%');
        return $qb->getQuery()->getResult();
    }

}