<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Teams;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * Team controller.
 *
 */
class TeamsController extends Controller
{
    /**
     * Lists all team entities.
     *
     */

    public function affectationMembreAction($idUs)
    {
        $em = $this->getDoctrine()->getManager();


        $user = $em->getRepository('SocialProNetworkBundle:Users')->find(3);
        $maxIdTeam = $em->getRepository('SocialProNetworkBundle:Teams')->maxIdTeam();
        $idTeamsSuivant = $maxIdTeam+1 ;

        $user->setStatus('4');
        $em->persist($user);
        $em->flush();

        $reponse = new JsonResponse();
        return $reponse->setData(array(
            'nomEq' => $maxIdTeam ,
        ));
    }

    public function statEquipeAction()
    {
        $em = $this->getDoctrine()->getManager();


        $statEquipe = $em->getRepository('SocialProNetworkBundle:Teams')->statEquipe();


        $obe = new Highchart();
        $obe->chart->renderTo('linechart2');
        $obe->title->text('rendement des équipes');
        $obe->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Doiitz', 45.0),
            array('root', 26.8),
            array('poitr', 12.8),
            array('lopit', 8.5),
            array('vteza', 6.2),
            array('yaerzt', 0.7),
        );
        $obe->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));


        return $this->render('teams/statEquipe.html.twig', array(
            'statEquipe' => $statEquipe,
            'chart2' => $obe,
        ));

    }

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $findTeams = $em->getRepository('SocialProNetworkBundle:Teams')->findAll();
        $paginator  = $this->get('knp_paginator');
        $teams = $paginator->paginate($findTeams,$request->query->getInt('page', 1),3);

        return $this->render('teams/index.html.twig', array(
            'teams' => $teams,
        ));
    }

    /**
     * Creates a new team entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $team = new Teams();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\TeamsType', $team);
        $form->handleRequest($request);

        $manager = $em->getRepository('SocialProNetworkBundle:Users')->userStatut('Manager');
        $scrumMaster = $em->getRepository('SocialProNetworkBundle:Users')->userStatut('ScrumMaster');
        $productOwner = $em->getRepository('SocialProNetworkBundle:Users')->userStatut('ProductOwner');
        $developper = $em->getRepository('SocialProNetworkBundle:Users')->userStatut('Developper');

        if ($form->isSubmitted() && $form->isValid()) {

            $team->setDateCreation(new \DateTime());
            $em->persist($team);
            $em->flush($team);

            return $this->redirectToRoute('adminTeams_show', array('id' => $team->getIdEq()));
        }

        return $this->render('teams/new.html.twig', array(
            'manager' => $manager,
            'scrumMaster' => $scrumMaster,
            'productOwner' => $productOwner,
            'developper' => $developper,
            'team' => $team,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a team entity.
     *
     */
    public function showAction(Teams $team)
    {
        $deleteForm = $this->createDeleteForm($team);

        return $this->render('teams/show.html.twig', array(
            'team' => $team,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing team entity.
     *
     */
    public function editAction(Request $request, Teams $team)
    {
        $deleteForm = $this->createDeleteForm($team);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\TeamsType', $team);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminTeams_edit', array('id' => $team->getIdEq()));
        }

        return $this->render('teams/edit.html.twig', array(
            'team' => $team,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a team entity.
     *
     */
    public function deleteAction(Request $request, Teams $team)
    {
        $form = $this->createDeleteForm($team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush();
        }

        return $this->redirectToRoute('adminTeams_index');
    }

    /**
     * Creates a form to delete a team entity.
     *
     * @param Teams $team The team entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Teams $team)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminTeams_delete', array('id' => $team->getIdEq())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
