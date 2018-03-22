<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Issues;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class IssuesFrontController extends Controller
{

    public function issuesPDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $issue = $em->getRepository('SocialProNetworkBundle:Issues')->find($id);

        if (!$issue) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('frontIssues'));
        }

        $html = $this->container->get('templating')->render('issues/frontOffice/issuesPDF.html.twig', array('issu' => $issue));

        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('SocialPro');
        $html2pdf->pdf->SetTitle('issues Projet '.'SocialPro');
        $html2pdf->pdf->SetSubject('issues SocialPro');
        $html2pdf->pdf->SetKeywords('issues,socialPro');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->Output('issues.pdf');

        $response = new Response();
        $response->headers->set('Content-type' , 'application/pdf');

        return $response;
    }

    public function issuessAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('SocialProNetworkBundle:Issues')->findAll();
        $id = $em->getRepository('SocialProNetworkBundle:Issues')->byMax();
        $issu = $em->getRepository('SocialProNetworkBundle:Issues')->find(1);
        $projets = $em->getRepository('SocialProNetworkBundle:Projets')->findAll();
        $users = $em->getRepository('SocialProNetworkBundle:Users')->findAll();


        if ($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $findProjet = $em->getRepository('SocialProNetworkBundle:Issues')->rechercheIssuess($request->get("search"));


            return $this->render('issues/frontOffice/listeIssues.html.twig', array(
                'users' => $users,
                'projets' => $findProjet,
                'issu' => $issu,
                'issues' => $issues,
            ));
        }

        $issue = new Issues();
        if ($request->isMethod('POST')){
            $idPro= $request->get('projets');
            $bug= $request->get('bug');
            $prio= $request->get('priority');
            $desc= $request->get('textarea');
            $idUs= $request->get('users');
            $issue->setIdprojet($idPro);
            $issue->setType($bug);
            $issue->setPriority($prio);
            $issue->setDescription($desc);
            $issue->setAssigneer($idUs);
            $em=$this->getDoctrine()->getManager();
            $em->persist($issue);
            $em->flush();
            return $this->redirectToRoute('frontIssues');
        }

        return $this->render('issues/frontOffice/listeIssues.html.twig', array(
            'users' => $users,
            'projets' => $projets,
            'issu' => $issu,
            'issues' => $issues,
        ));
    }

    public function issueDetailsAction($idIss)
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('SocialProNetworkBundle:Issues')->findAll();
        $issue = $em->getRepository('SocialProNetworkBundle:Issues')->find($idIss);


        return $this->render('issues/frontOffice/listeIssues.html.twig', array(

            'issu' => $issue,
            'issues' => $issues,
        ));
    }


}
