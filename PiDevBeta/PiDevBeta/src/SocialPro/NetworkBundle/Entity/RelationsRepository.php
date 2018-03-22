<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/3/2017
 * Time: 3:02 AM
 */

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\EntityRepository;

class RelationsRepository extends EntityRepository
{
    function MyRelations($myId)
    {
        $query = $this->getEntityManager()
            ->createQuery("select c from SocialProNetworkBundle:Relations c WHERE c.iduser = :id or c.idfriend = :id ")->setParameter('id',$myId);
        return $query->getResult();
    }


}