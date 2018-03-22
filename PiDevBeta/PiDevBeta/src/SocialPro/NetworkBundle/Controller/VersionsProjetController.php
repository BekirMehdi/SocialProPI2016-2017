<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Activites;
use SocialPro\NetworkBundle\Entity\VersionsProjet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



/**
 * Versionsprojet controller.
 *
 * @Route("versionsprojet")
 */
class VersionsProjetController extends Controller
{
    /**
     * Lists all versionsProjet entities.
     *
     * @Route("/", name="versionsprojet_index")
     * @Method("GET")
     */
    public function indexAction(Request $Request)
    {

        $em = $this->getDoctrine()->getManager();

        $em = $this->getDoctrine()->getManager();
        $versionsProjets = $em->getRepository('SocialProNetworkBundle:VersionsProjet')->findAll();
        $paginator=$this->get('knp_paginator');
        /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $versionsProjets= $paginator->paginate(
            $versionsProjets,
            $Request->query->getInt('page',1),
            $Request->query->getInt('limit',5)
          );
        $em = $this->getDoctrine()->getManager();
        $listactivites=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetlistactivitesDQL();
        $nbrvue=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetnbreactivitesDQL();
        return $this->render('versionsprojet/index.html.twig', array(
            'versionsProjets' => $versionsProjets,'listactivites'=>$listactivites,'nbrvue'=>$nbrvue,
        ));
    }



    /**
     * Creates a new versionsProjet entity.
     *
     * @Route("/new", name="versionsprojet_new")
     * @Method({"GET", "POST"})
     */
    public function AjouterVersionAction(Request $Request)
    {
        $modele = new Versionsprojet();
        $activites = new Activites();
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $username = $user->getUsername();
        $x=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetIdProjetDQL($userId);
        $y=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetNumSprintDQL($userId);

        if( $Request->getMethod()== 'POST') {

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userId = $user->getId();
            $username = $user->getUsername();
            $date = $Request->get('date');
            $idprojet = $em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetIdProjet2DQL($userId);
            $numversion = $Request->get('numversion2');
            $numsprint = $Request->get('numsprint');
            $description = $Request->get('description');
            $fichier = $Request->get('fichier');


            $date2 = new \DateTime($date);
            $modele->setDateCreation($date2);
            $modele->setIdProjet($idprojet);
            $modele->setNumVersion($numversion);
            $numsprint2=(int)$numsprint;
            $modele->setNumSprint($numsprint2);
            $modele->setFichier($fichier);
            $modele->setDescription($description);
            $descriptionActivites='a ajouté(e) une Nouvelle Version';



            $activites->setIduser($userId);
            $activites->setDescription($descriptionActivites);
            $activites->setDate($date2);
            $activites->setUsername($username);
            $activites->setVue('false');
            $em = $this->getDoctrine()->getManager();
            $em->persist($activites);

            $em->persist($modele); //insert
            $em->flush(); //exécuter


            return $this->redirectToRoute('versionsprojet_show', array('idVp' => $modele->getIdvp()));


        }
        $em = $this->getDoctrine()->getManager();
        $listactivites=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetlistactivitesDQL();
        $nbrvue=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetnbreactivitesDQL();
        return $this->render('versionsprojet/new.html.twig', array(
            'versionsProjet' => $modele,'x'=>$x,'y'=>$y,'listactivites'=>$listactivites,'nbrvue'=>$nbrvue,

        ));
    }

    /**
     *
     *
     * @Route("/{nomFichier}/{numSprint}", name="versionsprojet_AjaxFichier")
     * @Method("GET")
     */
    public function nbrFichierAction($nomFichier, $numSprint )
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $x=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetNombreFichierDQL($nomFichier,$numSprint,$idUser);
        return new Response((string)$x);
    }



    /**
     * Finds and displays a versionsProjet entity.
     *
     * @Route("/{idVp}", name="versionsprojet_show")
     * @Method("GET")
     */
    public function showAction(VersionsProjet $versionsProjet)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $nbrvue=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetnbreactivitesDQL();
        $x=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetIdProjetDQL($userId);
        $listactivites=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetlistactivitesDQL();
        $deleteForm = $this->createDeleteForm($versionsProjet);
        return $this->render('versionsprojet/show.html.twig', array(
            'versionsProjet' => $versionsProjet,'x'=>$x,'nbrvue'=>$nbrvue,'listactivites'=>$listactivites,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing versionsProjet entity.
     *
     * @Route("/{idVp}/edit", name="versionsprojet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $Request, VersionsProjet $versionsProjet)
    {   $activites = new Activites();
        $em = $this->getDoctrine()->getManager();
        $idversion=$versionsProjet->getIdVp();
        $version=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->find($idversion);
        if( $Request->getMethod()== 'POST') {

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userId = $user->getId();
            $username = $user->getUsername();
            $date = $Request->get('date');
            $idprojet = $em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetIdProjet2DQL($userId);
            $numversion = $Request->get('numversion2');
            $numsprint = $Request->get('numsprint');
            $description = $Request->get('description');
            $fichier = $Request->get('fichier');


            $date2 = new \DateTime($date);
            $version->setDateCreation($date2);
            $version->setIdProjet($idprojet);
            $version->setNumVersion($numversion);
            $numsprint2=(int)$numsprint;
            $version->setNumSprint($numsprint2);
            $version->setFichier($fichier);
            $version->setDescription($description);
            $descriptionActivites='a modifié(e) une Version';



            $activites->setIduser($userId);
            $activites->setDescription($descriptionActivites);
            $activites->setDate($date2);
            $activites->setUsername($username);
            $activites->setVue('false');
            $em = $this->getDoctrine()->getManager();

            $listactivites=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetlistactivitesDQL();
            $nbrvue=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetnbreactivitesDQL();
            $em->persist($activites);
            $em->flush(); //exécuter


            return $this->redirectToRoute('versionsprojet_show', array('idVp' => $version->getIdvp(),'listactivites'=>$listactivites,'nbrvue'=>$nbrvue,));


        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $username = $user->getUsername();
        $x=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetIdProjetDQL($userId);
        $y=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetNumSprintDQL($userId);

        $em = $this->getDoctrine()->getManager();
        $listactivites=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetlistactivitesDQL();
        $nbrvue=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetnbreactivitesDQL();

        return $this->render('versionsprojet/edit.html.twig', array(
            'versionsProjet' => $version,'x'=>$x,'y'=>$y,'listactivites'=>$listactivites,'nbrvue'=>$nbrvue,
        ));
    }

    /**
     * Deletes a versionsProjet entity.
     *
     * @Route("/{idVp}", name="versionsprojet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, VersionsProjet $versionsProjet)
    {
        $form = $this->createDeleteForm($versionsProjet);
        $form->handleRequest($request);
        $activites = new Activites();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($versionsProjet);
            $em->flush();
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $username = $user->getUsername();
        $activites->setIduser($userId);
        $descriptionActivites='a supprimé(e) une Version';
        $activites->setDescription($descriptionActivites);
        $date2 = $request->get('date');
        $date2 = new \DateTime($date2);
        $activites->setDate($date2);
        $activites->setUsername($username);
        $activites->setVue('false');
        $em = $this->getDoctrine()->getManager();
        $em = $this->getDoctrine()->getManager();
        $listactivites=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetlistactivitesDQL();
        $nbrvue=$em->getRepository('SocialProNetworkBundle:VersionsProjet')->GetnbreactivitesDQL();
        $em->persist($activites);
        $em->flush();
        return $this->redirectToRoute('versionsprojet_index',array('listactivites'=>$listactivites,'nbrvue'=>$nbrvue,));
    }

    /**
     * Creates a form to delete a versionsProjet entity.
     *
     * @param VersionsProjet $versionsProjet The versionsProjet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VersionsProjet $versionsProjet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('versionsprojet_delete', array('idVp' => $versionsProjet->getIdvp())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     *
     *
     * @Route("/{idactalite}", name="versionsprojet_AjaxModifierVue")
     * @Method("GET")
     */
    public function modifiervueAction($idactalite){

        $em = $this->getDoctrine()->getManager();

        $book =$em->getRepository('SocialProNetworkBundle:Activites')->findOneBy(array('idAc'=>$idactalite));

        if ($book) {
            $book->setVue("true");
            $em->flush();

        }

        $em->getRepository('SocialProNetworkBundle:VersionsProjet')->ModifierVueActiviteDQL($idactalite);
        return new Response();
    }



}
