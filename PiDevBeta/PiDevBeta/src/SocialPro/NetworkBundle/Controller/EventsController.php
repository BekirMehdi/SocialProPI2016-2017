<?php

 namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 */
class EventsController extends Controller
{
    /**
     * Lists all event entities.
     *
     */


    public function indexAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM SocialProNetworkBundle:Events a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        // parameters to template
        return $this->render('events/index.html.twig', array('events' => $pagination));
    }
    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('SocialProNetworkBundle:Events')->findAll();

        return $this->render('events/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $date=new \DateTime();

        $event = new Events("test",$date);
        $form = $this->createForm('SocialPro\NetworkBundle\Form\EventsType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush($event);

            return $this->redirectToRoute('adminEvents_show', array('id' => $event->getidEvent()));
        }

        return $this->render('events/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Events $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('events/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Events $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\EventsType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminEvents_show', array('id' => $event->getidEvent()));
        }

        return $this->render('events/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function calAction()
    {
        $em = $this->getDoctrine()->getManager();
        $activities = $em->getRepository('SocialProNetworkBundle:Events')->findAll();
        foreach($activities as &$v) {

            $v->setNom(utf8_encode($v->getNom()));
          $v->setDate(utf8_encode($v->getDate()->format('Y-m-d')));

        }
        foreach($activities as &$v){

            $list[] = array('title' => $v->getNom(), 'start' => $v->getDate()


            );
        }
        if (isset($list))
        {
            $fp = fopen('bundles/MainBundle/tables/index3.json', 'w');
            fwrite($fp, json_encode($list));
            fclose($fp);
        }
        return $this->render('events/calTest.html.twig',
            array('events' => $activities));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Events $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('adminEvents_index');
    }
    public function callAction()
    {
        return $this->render('events/calTest.html.twig');
    }
    /**
     * Creates a form to delete a event entity.
     *
     * @param Events $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Events $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminEvents_delete', array('id' => $event->getidEvent())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
