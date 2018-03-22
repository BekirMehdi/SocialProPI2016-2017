<?php


namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\UserStories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use SocialPro\NetworkBundle\Repository\TasksRepository;

/**
 * Userstory controller.
 *
 */
class UserStoriesController extends Controller
{
    /**
     * Lists all userStory entities.
     *
     */
    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $userStories = $em->getRepository('SocialProNetworkBundle:UserStories')->findAll();

        return $this->render('userstories/index.html.twig', array(
            'userStories' => $userStories,
        ));
    }

    public function indexAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM SocialProNetworkBundle:UserStories a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );

        // parameters to template
        return $this->render('userstories/index.html.twig', array('userStories' => $pagination));
    }

    /**
     * Creates a new userStory entity.
     *
     */
    public function newAction(Request $request)
    {
        $userStory = new UserStories();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\UserStoriesType', $userStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userStory);
            $em->flush($userStory);

            return $this->redirectToRoute('adminUserStories_show', array('id' => $userStory->getIdUs()));
        }

        return $this->render('userstories/new.html.twig', array(
            'userStory' => $userStory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userStory entity.
     *
     */
    public function showAction(UserStories $userStory)
    {
        $deleteForm = $this->createDeleteForm($userStory);

        return $this->render('userstories/show.html.twig', array(
            'userStory' => $userStory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userStory entity.
     *
     */
    public function editAction(Request $request, UserStories $userStory)
    {
        $deleteForm = $this->createDeleteForm($userStory);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\UserStoriesType', $userStory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminUserStories_show', array('id' => $userStory->getIdUs()));
        }

        return $this->render('userstories/edit.html.twig', array(
            'userStory' => $userStory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userStory entity.
     *
     */
    public function deleteAction(Request $request, UserStories $userStory)
    {
        $form = $this->createDeleteForm($userStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userStory);
            $em->flush();
        }

        return $this->redirectToRoute('adminUserStories_index');
    }

    /**
     * Creates a form to delete a userStory entity.
     *
     * @param UserStories $userStory The userStory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserStories $userStory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminUserStories_delete', array('id' => $userStory->getIdUs())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function Stat2Action()
    {
        $em= $this->getDoctrine()->getManager();
        $forums = $em->getRepository('SocialProNetworkBundle:Tasks')->stat("DONE");
        $forums1 = $em->getRepository('SocialProNetworkBundle:Tasks')->stat("TO DO");
        $forums2 = $em->getRepository('SocialProNetworkBundle:Tasks')->stat("DOING");
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('tasks');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('DONE', intval($forums)),
            array('TO DO', intval($forums1)),
            array('DOING', intval($forums2)),

        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render(':userstories:chart.html.twig', array(
            'chart' => $ob
        ));
    }
}
