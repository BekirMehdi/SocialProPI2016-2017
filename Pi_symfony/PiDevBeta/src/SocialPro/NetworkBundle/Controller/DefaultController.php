<?php

namespace SocialPro\NetworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SocialProNetworkBundle:Default:index.html.twig');
    }
}
