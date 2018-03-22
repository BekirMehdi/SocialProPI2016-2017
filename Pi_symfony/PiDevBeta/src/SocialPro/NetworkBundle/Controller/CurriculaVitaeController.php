<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/2/2017
 * Time: 12:47 AM
 */

namespace SocialPro\NetworkBundle\Controller;


use SocialPro\NetworkBundle\Entity\CurriculaVitae;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class CurriculaVitaeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $curriculaVitaes = $em->getRepository('SocialProNetworkBundle:CurriculaVitae')->findAll();
        $following = $em->getRepository('SocialProNetworkBundle:Relations')->findBy(array('iduser'=>$this->getUser()->getId()));
        $nbr = count($following);
        $followers = $em->getRepository('SocialProNetworkBundle:Relations')->findBy(array('idfriend'=>$this->getUser()->getId()));
        $nbrz = count($followers);

        $CV = $em->getRepository('SocialProNetworkBundle:CurriculaVitae')->findBy(array('iduser'=>$this->getUser()->getId()),array('datefrom'=>'desc'));

        return $this->render('curriculavitae/index.html.twig', array(
            'friends'=>$following,
            'curriculaVitaes' => $curriculaVitaes,
            'following'=>$nbr,
            'followers'=>$nbrz,
            'cv'=>$CV
        ));
    }


    public function findExperienceAction()
    {
        $em = $this->getDoctrine()->getManager();

        $experiences = $em->getRepository('SocialProNetworkBundle:CurriculaVitae')->findBy(array('iduser'=>$this->getUser(),'type'=>'Experience'),array('datefrom'=>'asc'));

        return $this->render('curriculavitae/index.html.twig', array(
            'experiences' => $experiences,
        ));
    }


    public function newAction(Request $request)
    {
        $curriculaVitae = new Curriculavitae();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\ExperienceType', $curriculaVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $curriculaVitae->setType("Experience");
            $curriculaVitae->setIduser($this->getUser());
            $em->persist($curriculaVitae);
            $em->flush();

            return $this->redirectToRoute('curriculavitae_show', array('idCv' => $curriculaVitae->getIdcv()));
        }

        return $this->render('curriculavitae/new.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'form' => $form->createView(),
        ));
    }
    public function  addExperienceAction(Request $request)
    {
        $curriculaVitae = new Curriculavitae();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\ExperienceType', $curriculaVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $curriculaVitae->setType("Experience");
            $curriculaVitae->setIduser($this->getUser());
            $em->persist($curriculaVitae);
            $em->flush();

            return $this->redirectToRoute('curriculavitae_show', array('idCv' => $curriculaVitae->getIdcv()));
        }

        return $this->render('curriculavitae/newExperience.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'form' => $form->createView(),
        ));

    }
    public function  addFormationAction(Request $request)
    {
        $curriculaVitae = new Curriculavitae();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\FormationType', $curriculaVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $curriculaVitae->setType("Formation");
            $curriculaVitae->setIduser($this->getUser());
            $em->persist($curriculaVitae);
            $em->flush();

            return $this->redirectToRoute('curriculavitae_show', array('idCv' => $curriculaVitae->getIdcv()));
        }

        return $this->render('curriculavitae/newFormation.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'form' => $form->createView(),
        ));

    }

    public function  addExpBénévolatAction(Request $request)
    {
        $curriculaVitae = new Curriculavitae();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\ExpBenevolatType', $curriculaVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $curriculaVitae->setType("Expérience de bénévolat");
            $curriculaVitae->setIduser($this->getUser());

            $em->persist($curriculaVitae);
            $em->flush();

            return $this->redirectToRoute('curriculavitae_show', array('idCv' => $curriculaVitae->getIdcv()));
        }

        return $this->render('curriculavitae/newExpBenevolat.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'form' => $form->createView(),
        ));

    }

    public function  addPublicationAction(Request $request)
    {
        $curriculaVitae = new Curriculavitae();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\PublicationType', $curriculaVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $curriculaVitae->setType("Publication");
            $curriculaVitae->setIduser($this->getUser());

            $em->persist($curriculaVitae);
            $em->flush();

            return $this->redirectToRoute('curriculavitae_show', array('idCv' => $curriculaVitae->getIdcv()));
        }

        return $this->render('curriculavitae/newPublication.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'form' => $form->createView(),
        ));

    }

    public function  addCertificationAction(Request $request)
    {
        $curriculaVitae = new Curriculavitae();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\CertificationType', $curriculaVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $curriculaVitae->setType("Certification");
            $curriculaVitae->setIduser($this->getUser());

            $em->persist($curriculaVitae);
            $em->flush();

            return $this->redirectToRoute('curriculavitae_show', array('idCv' => $curriculaVitae->getIdcv()));
        }

        return $this->render('curriculavitae/newCertification.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'form' => $form->createView(),
        ));

    }

    public function  addProjetAction(Request $request)
    {
        $curriculaVitae = new Curriculavitae();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\ProjetsType', $curriculaVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $curriculaVitae->setType("Projet");
            $curriculaVitae->setIduser($this->getUser());

            $em->persist($curriculaVitae);
            $em->flush();

            return $this->redirectToRoute('curriculavitae_show', array('idCv' => $curriculaVitae->getIdcv()));
        }

        return $this->render('curriculavitae/newProjet.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'form' => $form->createView(),
        ));

    }


    public function showAction(CurriculaVitae $curriculaVitae)
    {
        $deleteForm = $this->createDeleteForm($curriculaVitae);

        return $this->render('curriculavitae/show.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, CurriculaVitae $curriculaVitae)
    {
        $deleteForm = $this->createDeleteForm($curriculaVitae);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\CurriculaVitaeType', $curriculaVitae);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('curriculavitae_edit', array('idCv' => $curriculaVitae->getIdcv()));
        }

        return $this->render('curriculavitae/edit.html.twig', array(
            'curriculaVitae' => $curriculaVitae,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, CurriculaVitae $curriculaVitae)
    {
        $form = $this->createDeleteForm($curriculaVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($curriculaVitae);
            $em->flush();
        }

        return $this->redirectToRoute('curriculavitae_index');
    }


    private function createDeleteForm(CurriculaVitae $curriculaVitae)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('curriculavitae_delete', array('idCv' => $curriculaVitae->getIdcv())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function addExpAction($poste,$entreprise,$lieu,$from,$to,$description,$filename)
    {

        $cv = new CurriculaVitae();
        $cv->setType("Experience");
        $cv->setPost($poste);
        $cv->setLocal($entreprise);
        $cv->setPlace($lieu);
        $cv->setDatefrom(\DateTime::createFromFormat('d-m-Y', $from));
        $cv->setDateto(\DateTime::createFromFormat('d-m-Y', $to));
        $cv->setDescription($description);
        $filename = str_replace("-",".",$filename);
        $cv->setFile($filename);
        $cv->setIduser($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($cv);
        $em->flush();
        return new Response();
    }
    public function deleteExpAction ($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('SocialProNetworkBundle:CurriculaVitae')->findOneBy(array('idCv'=>$id));
        $em->remove($post);
        $em->flush();
        return new Response();

    }
}