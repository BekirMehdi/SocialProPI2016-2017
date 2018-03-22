<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/3/2017
 * Time: 10:16 AM
 */

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\EntityRepository;

use SocialPro\NetworkBundle\Entity;

class PostWebRepository extends EntityRepository
{
    function friendsPostsDQL($myId)
    {
        $query = $this->getEntityManager()
            ->createQuery("select c.idPo as idPo,
c.contenu as contenu,
c.dateinsert as dateinsert,
c.datemodification as datemodification,
c.link as link,
c.file as file ,
c.modified as postModified,
IDENTITY(c.iduser) as postIdUser , 
(select COUNT(o.idPwr) from SocialProNetworkBundle:PostWebReaction o where
o.idpost = c.idPo) as nbLikes,
u.photo as photo,
u.lastname as lastname,
u.firstname as firstname,
u.image as image
from SocialProNetworkBundle:PostsWeb c  join SocialProNetworkBundle:Users u 
with c.iduser=u.id  WHERE c.iduser in 
(select IDENTITY(n.iduser) from SocialProNetworkBundle:Relations n WHERE n.iduser = :id or n.idfriend = :id) 
OR c.iduser in 
(select IDENTITY(m.idfriend) from SocialProNetworkBundle:Relations m WHERE m.iduser = :id or m.idfriend = :id) 
 ORDER BY c.dateinsert DESC ,c.datemodification DESC")->setParameter('id',$myId);
        return $query->getResult();
    }

    function idusersLikeDQL()
    {
        $query = $this->getEntityManager()->
        createQuery("select c.iduser,c.idpost from SocialProNetworkBundle:PostWebReaction c ");
        return $query->getResult();
    }


}