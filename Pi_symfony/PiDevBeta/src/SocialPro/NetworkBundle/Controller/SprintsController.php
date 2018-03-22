<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Sprints;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sprint controller.
 *
 */
class SprintsController extends Controller
{
    /**
     * Lists all sprint entities.
     *
     */
    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $sprints = $em->getRepository('SocialProNetworkBundle:Sprints')->findAll();

        return $this->render('sprints/index.html.twig', array(
            'sprints' => $sprints,
        ));
    }

    public function indexAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM SocialProNetworkBundle:Sprints a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        // parameters to template
        return $this->render('sprints/index.html.twig', array('sprints' => $pagination));
    }

    /**
     * Creates a new sprint entity.
     *
     */
    public function newAction(Request $request)
    {
        $sprint = new Sprints();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\SprintsType', $sprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sprint);
            $em->flush($sprint);

            return $this->redirectToRoute('adminSprints_show', array('id' => $sprint->getIdSp()));
        }

        return $this->render('sprints/new.html.twig', array(
            'sprint' => $sprint,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sprint entity.
     *
     */
    public function showAction(Sprints $sprint)
    {
        $deleteForm = $this->createDeleteForm($sprint);

        return $this->render('sprints/show.html.twig', array(
            'sprint' => $sprint,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sprint entity.
     *
     */
    public function editAction(Request $request, Sprints $sprint)
    {
        $deleteForm = $this->createDeleteForm($sprint);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\SprintsType', $sprint);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminSprints_show', array('id' => $sprint->getIdSp()));
        }

        return $this->render('sprints/edit.html.twig', array(
            'sprint' => $sprint,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sprint entity.
     *
     */
    public function deleteAction(Request $request, Sprints $sprint)
    {
        $form = $this->createDeleteForm($sprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sprint);
            $em->flush();
        }

        return $this->redirectToRoute('adminSprints_index');
    }

    /**
     * Creates a form to delete a sprint entity.
     *
     * @param Sprints $sprint The sprint entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sprints $sprint)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminSprints_delete', array('id' => $sprint->getIdSp())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
