<?php
/**
 * Created by PhpStorm.
 * User: Hytsu
 * Date: 10/04/2017
 * Time: 05:39
 */

namespace SocialPro\NetworkBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserStoriesRepository extends EntityRepository
{
    public function stat($type)
    {
        $query = $this->getEntityManager()
            ->createQuery(" select COUNT(F.idTa)  from SocialProNetworkBundle:Tasks F where F.status ='$type'");

        return $query->getSingleScalarResult();
    }
}