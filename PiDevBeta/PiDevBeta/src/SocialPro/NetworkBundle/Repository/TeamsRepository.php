<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 09/04/2017
 * Time: 19:08
 */

namespace SocialPro\NetworkBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TeamsRepository extends \Doctrine\ORM\EntityRepository
{

    public function maxIdTeam()
    {
        $query = $this->createQueryBuilder('t');
        $query->select('t, MAX(t.idEq) AS max_id');
        $query->groupBy('t.idEq');
        $query->setMaxResults(1);
        $query->orderBy('max_id', 'DESC');

        return $query->getQuery()->getResult();
    }


    public function statEquipe()
    {
        return $this->createQueryBuilder('t')
            ->addSelect('p')
            ->leftJoin('t.idprojet', 'p')
            ->select('count(t.idEq)','t.name')
            ->where('p.idteam = t.idEq')
            ->groupBy('p.idteam')
            ->getQuery()->getResult();
    }

}