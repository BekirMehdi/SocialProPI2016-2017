<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Lieu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Lieu controller.
 *
 */
class LieuController extends Controller
{
    /**
     * Lists all lieu entities.
     *
     */


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lieus = $em->getRepository('SocialProNetworkBundle:Lieu')->findAll();



        return $this->render('lieu/index.html.twig', array(
            'lieus' => $lieus,
        ));
    }

    /**
     * Creates a new lieu entity.
     *
     */
    public function newAction(Request $request)
    {
        $lieu = new Lieu();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\LieuType', $lieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lieu);
            $em->flush($lieu);

            $message = \Swift_Message::newInstance()
                ->setSubject('notification lieu')
                ->setFrom('hamadihawari@gmail.com')
                ->setTo('amal.bedoui@esprit.tn')
                ->setBody(
                    'new lieu added'
                )
            ;
            $this->get('mailer')->send($message);
            return $this->redirectToRoute('adminLieu_show', array('id' => $lieu->getIdLi()));
        }

        return $this->render('lieu/new.html.twig', array(
            'lieu' => $lieu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lieu entity.
     *
     */
    public function showAction(Lieu $lieu)
    {
        $deleteForm = $this->createDeleteForm($lieu);

        return $this->render('lieu/show.html.twig', array(
            'lieu' => $lieu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing lieu entity.
     *
     */
    public function editAction(Request $request, Lieu $lieu)
    {
        $deleteForm = $this->createDeleteForm($lieu);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\LieuType', $lieu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminLieu_show', array('id' => $lieu->getIdLi()));
        }

        return $this->render('lieu/edit.html.twig', array(
            'lieu' => $lieu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a lieu entity.
     *
     */
    public function deleteAction(Request $request, Lieu $lieu)
    {
        $form = $this->createDeleteForm($lieu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lieu);
            $em->flush();
        }

        return $this->redirectToRoute('adminLieu_index');
    }

    /**
     * Creates a form to delete a lieu entity.
     *
     * @param Lieu $lieu The lieu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lieu $lieu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminLieu_delete', array('id' => $lieu->getIdLi())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
