<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Meetings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * Meeting controller.
 *
 */
class MeetingsController extends Controller
{
    /**
     * Lists all meeting entities.
     *
     */

    public function Stat2Action()
    {
        $em= $this->getDoctrine()->getManager();
        $forums  = $em->getRepository('SocialProNetworkBundle:Meetings')->stat("Daily scrum");
        $forums1 = $em->getRepository('SocialProNetworkBundle:Meetings')->stat("Post-sprint meeting");
        $forums2 = $em->getRepository('SocialProNetworkBundle:Meetings')->stat("Sprint planning meeting");
        $forums3 = $em->getRepository('SocialProNetworkBundle:Meetings')->stat("Pre-sprint");
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('meetings');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Daily scrum', intval($forums)),
            array('Post-sprint meeting', intval($forums1)),
            array('Sprint planning meeting', intval($forums2)),
            array('Pre-sprint', intval($forums3)),

        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('meetings/stat_pdf.html.twig', array(
            'chart' => $ob
        ));
    }
    public function PdfmeetingAction()
    {
        $em = $this->getDoctrine()->getManager();
        $forum = $em->getRepository("SocialProNetworkBundle:Meetings")->findAll();
        $html = $this->renderView('meetings/pdf.html.twig',
            array('meetings' =>$forum));
        //on appelle le service html2pdf
        $html2pdf = $this->get('html2pdf_factory')->create();
//real : utilise la taille réelle
        $html2pdf->pdf->SetDisplayMode('real');
//writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
        $html2pdf->writeHTML($html);
//Output envoit le document PDF au navigateur internet
        return new Response($html2pdf->Output('meeting.pdf'), 200, array('Content-Type' => 'application/pdf'));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $meetings = $em->getRepository('SocialProNetworkBundle:Meetings')->findAll();

/*
        $activities = $em->getRepository('myappSocialProBundle:Meetings')->findAll();
        foreach($activities as &$v) {
            $v->setIdMe(utf8_encode($v->getIdMe()));
            $v->setType(utf8_encode($v->getType()));
            //$v->setDate(utf8_encode($v->getDate()));
            $v->setDescription(utf8_encode($v->getDescription()));
            $v->setDuree(utf8_encode( $v->getDuree() ));
            $v->setLieu(utf8_encode( $v->getLieu()));
        }
        foreach($activities as &$v){
            $link=utf8_encode("<a href='/myappSocialProBundle/web/app_dev.php/meeting/").$v->getIdMe();
            $link=$link.utf8_encode("/edit'>Edit</a>");
            $link1=utf8_encode("<a href='/myappSocialProBundle/web/app_dev.php/meeting/").$v->getIdMe();
            $link1=$link1.utf8_encode("/delete'>Delete</a>");
            $list[] = array('Id' => $v->getIdMe(), 'Type' => $v->getType(), 'Date' => $v->getDate(),
                'Description' => $v->getDescription(), 'Duree'=>$v->getDuree(),'Lieu' => $v->getLieu()
            );
        }
        if (isset($list))
        {
            $fp = fopen('bundles/index3.json', 'w');
            fwrite($fp, json_encode($list));
            fclose($fp);
        }*/
        return $this->render('meetings/index.html.twig', array(
            'meetings' => $meetings));
    }

    /**
     * Creates a new meeting entity.
     *
     */
    public function newAction(Request $request)
    {
        $meeting = new Meetings();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\MeetingsType', $meeting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($meeting->getType()=='Sprint planning meeting')
                $meeting->setDuree(8);
            else if ($meeting->getType()=='Daily Scrum')
                $meeting->setDuree(15);
            else if ($meeting->getType()=='Post-sprint meeting')
                $meeting->setDuree(2);
            else if ($meeting->getType()=='Rétrospective-meeting')
                $meeting->setDuree(2);
            $em->persist($meeting);
            $em->flush($meeting);

            return $this->redirectToRoute('adminMeetings_show', array('id' => $meeting->getidMe()));
        }

        $em = $this->getDoctrine()->getManager();

        $meetings = $em->getRepository('myappSocialProBundle:Lieu')->findAll();

        return $this->render('meetings/new.html.twig', array(
            'meeting' => $meeting,
            'form' => $form->createView(),
            'meetings' => $meetings,
        ));
    }

    /**
     * Finds and displays a meeting entity.
     *
     */
    public function showAction(Meetings $meeting)
    {
        $deleteForm = $this->createDeleteForm($meeting);

        return $this->render('meetings/show.html.twig', array(
            'meeting' => $meeting,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing meeting entity.
     *
     */
    public function editAction(Request $request, Meetings $meeting)
    {
        $deleteForm = $this->createDeleteForm($meeting);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\MeetingsType', $meeting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminMeetings_show', array('id' => $meeting->getidMe()));
        }

        return $this->render('meetings/edit.html.twig', array(
            'meeting' => $meeting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a meeting entity.
     *
     */
    public function deleteAction(Request $request, Meetings $meeting)
    {
        $form = $this->createDeleteForm($meeting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($meeting);
            $em->flush();
        }

        return $this->redirectToRoute('adminMeetings_index');
    }

    /**
     * Creates a form to delete a meeting entity.
     *
     * @param Meetings $meeting The meeting entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Meetings $meeting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminMeetings_delete', array('id' => $meeting->getidMe())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
