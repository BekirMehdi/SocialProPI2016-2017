<?php

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\Projets;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Projet controller.
 *
 */
class ProjetsController extends Controller
{ /**
 * Lists all projet front entities.
 *
 */


    public function rechercheProjetsAction(Request $request)
    {
        if ($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $projets = $em->getRepository('SocialProNetworkBundle:Projets')->rechercheProjets($request->get("search"));
            return $this->render('projets/frontOffice/projetsRecherche.html.twig', array('projets' => $projets));

        }

    }

    public function accesDetailsAction($idPo)
    {
        $em = $this->getDoctrine()->getManager();


        $projet = $em->getRepository('SocialProNetworkBundle:Projets')->find($idPo);

        $accesProjet=$projet->getAccess();


        $reponse = new JsonResponse();
        return $reponse->setData(array(
            'idProjet' => $idPo,
            'accesProjet' => $accesProjet,
        ));
    }


    public function projetsAccesAction(Request $request )
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('SocialProNetworkBundle:Projets')->findAll();


        if ($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $findProjet = $em->getRepository('SocialProNetworkBundle:Projets')->rechercheProjets($request->get("search"));


            return $this->render('projets/frontOffice/acces.html.twig', array(

                'projets' => $findProjet,
            ));
        }
        if ($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $y=$request->get("idProj");
            if($y!=null) {

                $findProjet = $em->getRepository('SocialProNetworkBundle:Projets')->find($y);
                $x = $request->get("acces");
                $findProjet->setAccess($x);
                $em->persist($findProjet);
                $em->flush();

                return $this->render('projets/frontOffice/acces.html.twig', array(
                    'projets' => $projets,
                ));
            }
        }

        return $this->render('projets/frontOffice/acces.html.twig', array(
            'projets' => $projets,
        ));
    }

    public function browseprojectsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $findProjets = $em->getRepository('SocialProNetworkBundle:Projets')->findAll();
        $users = $em->getRepository('SocialProNetworkBundle:Users')->findAll();
        $nbF = $em->getRepository('SocialProNetworkBundle:Projets')->nbF();
        $nbD = $em->getRepository('SocialProNetworkBundle:Projets')->nbD();
        $nbE = $em->getRepository('SocialProNetworkBundle:Projets')->nbE();

        $paginator  = $this->get('knp_paginator');
        $projets = $paginator->paginate($findProjets,$request->query->getInt('page', 1),4);


        if ($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $findProjet = $em->getRepository('SocialProNetworkBundle:Projets')->rechercheProjets($request->get("search"));
            $paginator  = $this->get('knp_paginator');
            $projet = $paginator->paginate($findProjet,$request->query->getInt('page', 1),4);

            return $this->render('projets/frontOffice/browseProjects.html.twig', array(
                'nbE' => $nbE,
                'nbD' => $nbD,
                'nbF' => $nbF,
                'users' => $users,
                'projets' => $projet,
            ));
        }

        return $this->render('projets/frontOffice/browseProjects.html.twig', array(
            'nbE' => $nbE,
            'nbD' => $nbD,
            'nbF' => $nbF,
            'users' => $users,
            'projets' => $projets,
        ));
    }

    public function projectDetailsAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $projet = $em->getRepository('SocialProNetworkBundle:Projets')->find($id);
        $projets = $em->getRepository('SocialProNetworkBundle:Projets')->findAll();


        $rest = substr($projet->getDateCreation(), 0, 2);



        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,3))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);

        /**************************************************/

        /*************************************************/

        $obe = new Highchart();
        $obe->chart->renderTo('linechart2');
        $obe->title->text('Browser market shares at a specific website in 2010');
        $obe->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Firefox', 45.0),
            array('IE', 26.8),
            array('Chrome', 12.8),
            array('Safari', 8.5),
            array('Opera', 6.2),
            array('Others', 0.7),
        );
        $obe->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        /**************************************************/


        return $this->render('projets/frontOffice/projetDetails.html.twig', array(
            'projets' => $projets,
            'projet' => $projet,
            'chart' => $ob,
            'chart2' => $obe,
        ));
    }

    public function progressionProjectsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('SocialProNetworkBundle:Projets')->findAll();
        $nbF = $em->getRepository('SocialProNetworkBundle:Projets')->nbF();
        $nbD = $em->getRepository('SocialProNetworkBundle:Projets')->nbD();
        $nbE = $em->getRepository('SocialProNetworkBundle:Projets')->nbE();


        $obe = new Highchart();
        $obe->chart->renderTo('linechart2');
        $obe->title->text('rendement des équipes');
        $obe->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Doiitz', 45.0),
            array('root', 26.8),
            array('poitr', 12.8),
            array('lopit', 8.5),
            array('vteza', 6.2),
            array('yaerzt', 0.7),
        );
        $obe->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));


        return $this->render('projets/frontOffice/progressionProjets.html.twig', array(
            'projets' => $projets,
            'nbE' => $nbE,
            'nbD' => $nbD,
            'nbF' => $nbF,
            'chart2' => $obe,
        ));
    }


    public function projectsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $findProjets = $em->getRepository('SocialProNetworkBundle:Projets')->findAll();

        $paginator  = $this->get('knp_paginator');
        $projets = $paginator->paginate($findProjets,$request->query->getInt('page', 1),12);

        if ($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $findProjet = $em->getRepository('SocialProNetworkBundle:Projets')->rechercheProjets($request->get("search"));
            $paginator  = $this->get('knp_paginator');
            $projet = $paginator->paginate($findProjet,$request->query->getInt('page', 1),4);

            return $this->render('projets/frontOffice/projects.html.twig', array(
                'projets' => $projet,
            ));
        }

        return $this->render('projets/frontOffice/projects.html.twig', array(
            'projets' => $projets,
        ));
    }
    /**
     * Lists all projet entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $findProjets = $em->getRepository('SocialProNetworkBundle:Projets')->findAll();

        $paginator  = $this->get('knp_paginator');
        $projets = $paginator->paginate($findProjets,$request->query->getInt('page', 1),3);

        return $this->render('projets/backOffice/index.html.twig', array(
            'projets' => $projets,
        ));
    }

    /**
     * Creates a new projet entity.
     *
     */
    public function newAction(Request $request)
    {
        $projet = new Projets();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\ProjetsType', $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $projet->setDateCreation(new \DateTime());
            $projet->getImage()->setNomImage('image');
            $em->persist($projet);
            $em->flush($projet);

            return $this->redirectToRoute('adminProjets_show', array('id' => $projet->getIdPo()));
        }

        return $this->render('projets/backOffice/new.html.twig', array(
            'projet' => $projet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projet entity.
     *
     */
    public function showAction(Projets $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);

        return $this->render('projets/backOffice/show.html.twig', array(
            'projet' => $projet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projet entity.
     *
     */
    public function editAction(Request $request, Projets $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);
        $editForm = $this->createForm('SocialPro\NetworkBundle\Form\ProjetsType', $projet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminProjets_edit', array('id' => $projet->getIdPo()));
        }

        return $this->render('projets/backOffice/edit.html.twig', array(
            'projet' => $projet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projet entity.
     *
     */
    public function deleteAction(Request $request, Projets $projet)
    {
        $form = $this->createDeleteForm($projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projet);
            $em->flush();
        }

        return $this->redirectToRoute('adminProjets_index');
    }

    /**
     * Creates a form to delete a projet entity.
     *
     * @param Projets $projet The projet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projets $projet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminProjets_delete', array('id' => $projet->getIdPo())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}
