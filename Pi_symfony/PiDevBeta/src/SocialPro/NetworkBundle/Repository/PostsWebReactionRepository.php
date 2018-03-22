<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/7/2017
 * Time: 10:42 PM
 */

namespace SocialPro\NetworkBundle\Entity;


class PostsWebReactionRepository extends EntityRepository
{
    function friendsPosts($myId)
    {
        $query = $this->getEntityManager()
            ->createQuery("select c from SocialProNetworkBundle:PostsWeb c WHERE c.iduser in (select IDENTITY(n.iduser) from SocialProNetworkBundle:Relations n WHERE n.iduser = :id or n.idfriend = :id) OR c.iduser in (select IDENTITY(m.idfriend) from SocialProNetworkBundle:Relations m WHERE m.iduser = :id or m.idfriend = :id)  ORDER BY c.dateinsert DESC ,c.datemodification DESC")->setParameter('id',$myId);
        return $query->getResult();
    }


}