<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Issues;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Issue controller.
 *
 */
class IssuesController extends Controller
{
    /**
     * Lists all issue entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $findissues = $em->getRepository('SocialProNetworkBundle:Issues')->findAll();


        $paginator  = $this->get('knp_paginator');
        $issues = $paginator->paginate($findissues,$request->query->getInt('page', 1),3);

        return $this->render('issues/backOffice/index.html.twig', array(
            'issues' => $issues,
        ));
    }

    /**
     * Creates a new issue entity.
     *
     */
    public function newAction(Request $request)
    {
        $issue = new Issues();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\IssuesType', $issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $issue->setReporter($this->get('security.token_storage')->getToken()->getUser());
            $issue->setDateCreation(new \DateTime());
            $em->persist($issue);
            $em->flush($issue);

            return $this->redirectToRoute('adminIssues_show', array('id' => $issue->getIdIss()));
        }

        return $this->render('issues/backOffice/new.html.twig', array(
            'issue' => $issue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a issue entity.
     *
     */
    public function showAction(Issues $issue)
    {
        $deleteForm = $this->createDeleteForm($issue);

        return $this->render('issues/backOffice/show.html.twig', array(
            'issue' => $issue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing issue entity.
     *
     */
    public function editAction(Request $request, Issues $issue)
    {
        $deleteForm = $this->createDeleteForm($issue);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\IssuesType', $issue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminIssues_edit', array('id' => $issue->getIdIss()));
        }

        return $this->render('issues/backOffice/edit.html.twig', array(
            'issue' => $issue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a issue entity.
     *
     */
    public function deleteAction(Request $request, Issues $issue)
    {
        $form = $this->createDeleteForm($issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($issue);
            $em->flush();
        }

        return $this->redirectToRoute('adminIssues_index');
    }

    /**
     * Creates a form to delete a issue entity.
     *
     * @param Issues $issue The issue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Issues $issue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminIssues_delete', array('id' => $issue->getIdIss())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
