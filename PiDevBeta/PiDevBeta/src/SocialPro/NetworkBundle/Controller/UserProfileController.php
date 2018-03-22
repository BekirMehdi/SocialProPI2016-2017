<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/9/2017
 * Time: 4:24 PM
 */

namespace SocialPro\NetworkBundle\Controller;



use SocialPro\NetworkBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class UserProfileController extends Controller
{
    public function editAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $Modele = $em->getRepository('SocialPro\NetworkBundle\Entity\Users')
            ->find($this->getUser()->getId());


        $form = $this->createForm('SocialPro\NetworkBundle\Form\UsersType', $this->getUser());
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->persist($Modele);
            $em->flush();
            return $this->redirectToRoute('curriculavitae/index.html.twig');
        }
        return $this->render('curriculavitae/settings.html.twig',array(
            'form'=>$form->createView()
        ));

    }

}