<?php
/**
 * Created by PhpStorm.
 * User: Amal
 * Date: 10/04/2017
 * Time: 01:23
 */

namespace SocialPro\NetworkBundle\Repository;


use Doctrine\ORM\EntityRepository;

class MeetingsRepository extends EntityRepository
{
    public function stat($type)
    {
        $query = $this->getEntityManager()
            ->createQuery("select COUNT(F.idMe)  from SocialProNetworkBundle:Meetings F where F.type ='$type'");

        return $query->getSingleScalarResult();
    }
}