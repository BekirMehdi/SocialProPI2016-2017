<?php

/**
 * Created by PhpStorm.
 * User: Skander-pc
 * Date: 02/04/2017
 * Time: 07:15
 */

namespace SocialPro\NetworkBundle\Repository;

use \Doctrine\ORM\EntityRepository ;
use FOS\UserBundle\Model\User;

class VersionRepository extends EntityRepository
{

function GetIdProjetDQL($idUser){

    $query=$this->getEntityManager()->createQuery("SELECT c FROM SocialProNetworkBundle:Projets c WHERE c.idPo =(SELECT n.idProjet FROM SocialProNetworkBundle:Users n WHERE n.id =:idUser)")->setParameter('idUser',$idUser);
    return $query->getResult();
}
    function GetIdProjet2DQL($idUser){

        $query=$this->getEntityManager()->createQuery("SELECT c.idPo FROM SocialProNetworkBundle:Projets c WHERE c.idPo =(SELECT n.idProjet FROM SocialProNetworkBundle:Users n WHERE n.id =:idUser)")->setParameter('idUser',$idUser);
        $s = $query->getResult(); // array of CmsUser username and name values
        return $s[0]['idPo'];

    }

function GetNumSprintDQL($idUser){
        $query=$this->getEntityManager()->createQuery("SELECT b FROM SocialProNetworkBundle:Sprints b WHERE b.idprojet =(SELECT p.idPo FROM SocialProNetworkBundle:Projets p   INNER JOIN  SocialProNetworkBundle:Users u WITH p.idPo=u.idProjet WHERE u.id=:idUser)")->setParameter('idUser',$idUser);
        return $query->getResult();
    }

function GetNombreFichierDQL($nomfich,$numsp,$idUser)
{
    $parameters = array(
        'nomfich' => $nomfich
    ,'numsp' => $numsp
    ,'idUser'=>$idUser
    );

    $query=$this->getEntityManager()->createQuery("SELECT COUNT(d.fichier) FROM SocialProNetworkBundle:VersionsProjet d WHERE d.fichier=:nomfich AND d.numSprint=:numsp AND d.idProjet=(SELECT p.idPo FROM SocialProNetworkBundle:Projets p  INNER JOIN SocialProNetworkBundle:Users u WITH p.idPo=u.idProjet WHERE u.id=:idUser)")->setParameters($parameters);
    return $query->getSingleScalarResult();
}

function GetnbreactivitesDQL()
    {
        $query=$this->getEntityManager()->createQuery("SELECT COUNT(j.vue) FROM SocialProNetworkBundle:Activites j WHERE j.vue='false' ");
        return $query->getSingleScalarResult();

    }
function GetlistactivitesDQL(){
    $query=$this->getEntityManager()->createQuery("SELECT j FROM SocialProNetworkBundle:Activites j ORDER BY j.idAc DESC ");
    return $query->getResult();
}
function ModifierVueActiviteDQL($idactalite){
        $query=$this->getEntityManager()
            ->createQuery("update SocialProNetworkBundle:Activites a set a.vue='true' where a.idAc=:idAc")
            ->setParameter('idAc',$idactalite);
        return $query->execute();
}



}