<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 5/18/2017
 * Time: 7:10 PM
 */

namespace SocialPro\NetworkBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SocialPro\NetworkBundle\User;
use belousovr\belousovChatBundle\Form\ChatType;

/**
 * Description of ChatController
 *
 * @author root
 */
class ChatController extends Controller
{
    /**
     * @Route("/chat/", name="chatpage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findAll();

        $user = $this->getUser();

        $id=$user->getId();

        $actionUrl = $this->generateUrl(
            'belousov_chat_ajax_send_message'
        );

        $getMessageUrl = $this->generateUrl(
            'belousov_chat_ajax_get_message'
        );

        $chatForm = $this->createForm(ChatType::class, null, array('action' => $actionUrl));

        return $this->render('default/videocall.html.twig', array('id'=>$id, 'chatForm' => $chatForm->createView(), 'users' => $users, 'getMessageUrl' => $getMessageUrl, 'currentUser' => $this->getUser()));
    }

    public function indAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findAll();

        $user = $this->getUser();

        $id=$user->getId();

        $actionUrl = $this->generateUrl(
            'belousov_chat_ajax_send_message'
        );

        $getMessageUrl = $this->generateUrl(
            'belousov_chat_ajax_get_message'
        );

        $chatForm = $this->createForm(ChatType::class, null, array('action' => $actionUrl));

        return $this->render('default/videocall.html.twig', array('id'=>$id, 'chatForm' => $chatForm->createView(), 'users' => $users, 'getMessageUrl' => $getMessageUrl, 'currentUser' => $this->getUser()));
    }
}