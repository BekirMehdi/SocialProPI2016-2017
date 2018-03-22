<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Tasks;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * Task controller.
 *
 */
class TasksController extends Controller
{

    public function chartAction()
    {
        // Chart
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Tasks');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);

        return $this->render('tasks/index.html.twig', array(
            'chart' => $ob
        ));
    }

    public function indexAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM SocialProNetworkBundle:Tasks a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        // parameters to template
        return $this->render('tasks/index.html.twig', array('tasks' => $pagination));
    }

    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository('SocialProNetworkBundle:Tasks')->findAll();

        return $this->render('tasks/index.html.twig', array(
            'tasks' => $tasks,
        ));
    }

    public function tasksAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository('myappSocialProBundle:Tasks')->findAll();

        return $this->render('tasks/tasks.html.twig', array(
            'tasks' => $tasks,
        ));
    }

    public function tasksJsonAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository('SocialProNetworkBundle:Tasks')->findAll();

        return $this->render('tasks/tasks.html.twig', array(
            'tasks' => $tasks,
        ));
    }

    /**
     * Creates a new task entity.
     *
     */
    public function newAction(Request $request)
    {
        $task = new Tasks();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\TasksType', $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush($task);

            return $this->redirectToRoute('tasks_show', array('id' => $task->getIdTa()));
        }

        return $this->render('tasks/new.html.twig', array(
            'task' => $task,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a task entity.
     *
     */
    public function showAction(Tasks $task)
    {
        $deleteForm = $this->createDeleteForm($task);

        return $this->render('tasks/show.html.twig', array(
            'task' => $task,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing task entity.
     *
     */
    public function editAction(Request $request, Tasks $task)
    {
        $deleteForm = $this->createDeleteForm($task);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\TasksType', $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tasks_edit', array('id' => $task->getIdTa()));
        }

        return $this->render('tasks/edit.html.twig', array(
            'task' => $task,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a task entity.
     *
     */
    public function deleteAction(Request $request, Tasks $task)
    {
        $form = $this->createDeleteForm($task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();
        }

        return $this->redirectToRoute('tasks_index');
    }

    /**
     * Creates a form to delete a task entity.
     *
     * @param Tasks $task The task entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tasks $task)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tasks_delete', array('id' => $task->getIdTa())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function taskBoardAction()
    {
        return $this->render('tasks/taskBoard.html.twig');
    }

    public function displayTaskBoardAction()
    {
        $em = $this->getDoctrine()->getManager();
        $activitiesTODO = $em->getRepository('SocialProNetworkBundle:Tasks')->findBy( array('status' => 'TO DO'));
        foreach($activitiesTODO as &$v) {
            $v->setIdTa(utf8_encode($v->getIdTa()));
            $v->setName(utf8_encode($v->getName()));
            $v->setDescription(utf8_encode($v->getDescription()));
            $v->setStatus(utf8_encode($v->getStatus())) ;

        }
        foreach($activitiesTODO as &$v){

            $meme[] = array (
                "id" => "uid_5",
                "name" => "Edward Fletcher",
                "img" => "",
            ) ;
            $Sub=array(array (
                "title" => "subtask 1",
                "complete" => "true",
            ),
                array (
                    "title" => "subtask 2",
                    "complete" => "false"
                ));
            $Attachement=array( array (
                "title" => "attachment 1",
                "src" => "",
                "size" => "500K"
            ),
                array (
                    "title" => "attachment 2",
                    "src" => ".",
                    "size" => "2.04M"
                ));
            $Comments=array(array (
                "user" => "Caleb Richards",
                "src" => "",
                "time" => "",
                "content" => "Brute existim"
            ),
                array (
                    "user" => "Mary Adams",
                    "src" => "",
                    "time" => "16 hours ago",
                    "content" => "Deduceret, stabilitas diligenter"
                ));
            $TasksDO[]=array(
                "complete"=> "false",
                "title" => $v->getName(),
                "description" => $v->getDescription(),
                "priority" => "urgent",
                "duedate" => "",
                "members" => $meme,
                "subtasks" => $Sub,
                "attachments" =>$Attachement,
                "comments" => $Comments

            );
            $listDO =  array('title' => " TO DO",
                'tasks' => $TasksDO
            );
        }
        $activitiesDOING = $em->getRepository('SocialProNetworkBundle:Tasks')->findBy( array('status' => 'DOING'));
        foreach($activitiesDOING as &$v) {
            $v->setIdTa(utf8_encode($v->getIdTa()));
            $v->setName(utf8_encode($v->getName()));
            $v->setDescription(utf8_encode($v->getDescription()));
            $v->setStatus(utf8_encode($v->getStatus())) ;

        }
        foreach($activitiesDOING as &$v){

            $meme[] = array (
                "id" => "uid_5",
                "name" => "Edward Fletcher",
                "img" => "",
            ) ;
            $Sub=array(array (
                "title" => "subtask 1",
                "complete" => "true",
            ),
                array (
                    "title" => "subtask 2",
                    "complete" => "false"
                ));
            $Attachement=array( array (
                "title" => "attachment 1",
                "src" => "",
                "size" => "500K"
            ),
                array (
                    "title" => "attachment 2",
                    "src" => ".",
                    "size" => "2.04M"
                ));
            $Comments=array(array (
                "user" => "Caleb Richards",
                "src" => "",
                "time" => "",
                "content" => "Brute existim"
            ),
                array (
                    "user" => "Mary Adams",
                    "src" => "",
                    "time" => "16 hours ago",
                    "content" => "Deduceret, stabilitas diligenter"
                ));
            $TasksDOING[]=array(
                "complete"=> "false",
                "title" => $v->getName(),
                "description" => $v->getDescription(),
                "priority" => "urgent",
                "duedate" => "",
                "members" => $meme,
                "subtasks" => $Sub,
                "attachments" =>$Attachement,
                "comments" => $Comments

            );
            $listDOING =  array('title' => "DOING",
                'tasks' => $TasksDOING
            );
        }

        $activitiesDONE = $em->getRepository('SocialProNetworkBundle:Tasks')->findBy( array('status' => 'DONE'));
        foreach($activitiesDONE as &$v) {
            $v->setIdTa(utf8_encode($v->getIdTa()));
            $v->setName(utf8_encode($v->getName()));
            $v->setDescription(utf8_encode($v->getDescription()));
            $v->setStatus(utf8_encode($v->getStatus())) ;

        }
        foreach($activitiesDONE as &$v){

            $meme[] = array (
                "id" => "uid_5",
                "name" => "Edward Fletcher",
                "img" => "",
            ) ;
            $Sub=array(array (
                "title" => "subtask 1",
                "complete" => "true",
            ),
                array (
                    "title" => "subtask 2",
                    "complete" => "false"
                ));
            $Attachement=array( array (
                "title" => "attachment 1",
                "src" => "",
                "size" => "500K"
            ),
                array (
                    "title" => "attachment 2",
                    "src" => ".",
                    "size" => "2.04M"
                ));
            $Comments=array(array (
                "user" => "Caleb Richards",
                "src" => "",
                "time" => "",
                "content" => "Brute existim"
            ),
                array (
                    "user" => "Mary Adams",
                    "src" => "",
                    "time" => "16 hours ago",
                    "content" => "Deduceret, stabilitas diligenter"
                ));
            $TasksDONE[]=array(
                "complete"=> "false",
                "title" => $v->getName(),
                "description" => $v->getDescription(),
                "priority" => "urgent",
                "duedate" => "",
                "members" => $meme,
                "subtasks" => $Sub,
                "attachments" =>$Attachement,
                "comments" => $Comments

            );
            $listDONE =  array('title' => "DOING",
                'tasks' => $TasksDONE
            );
        }

        $list = array($listDO,$listDOING,$listDONE) ;
        if (isset($list))
        {

            $fp = fopen('bundles/index3.json', 'w');
            fwrite($fp, json_encode($list));
            fclose($fp);
        }
        return $this->render('tasks/tasks.html.twig');
    }

    public function Stat2Action()
    {
        $em= $this->getDoctrine()->getManager();
        $forums  = $em->getRepository('SocialProNetworkBundle:Tasks')->stat("DONE");
        $forums1 = $em->getRepository('SocialProNetworkBundle:Tasks')->stat("TO DO");
        $forums2 = $em->getRepository('SocialProNetworkBundle:Tasks')->stat("DOING");
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('tasks');
        $ob->plotOptions->line(array(
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
        $ob->series(array(array('type' => 'line','name' => 'Browser share', 'data' => $data)));
        return $this->render(':Tasks:chart.html.twig', array(
            'chart' => $ob
        ));
    }

}
