<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/3/2017
 * Time: 2:46 AM
 */

namespace SocialPro\NetworkBundle\Controller;

use SocialPro\NetworkBundle\Entity\CommentsWeb;
use SocialPro\NetworkBundle\Entity\PostsWeb;
use SocialPro\NetworkBundle\Entity\PostWebReaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use SocialPro\NetworkBundle\Entity\Users;

use SocialPro\NetworkBundle\Entity\Relations;

class PostsWebController extends Controller
{
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user =  $this->getUser();
        $id = $user->getId();
//******* get all the posts of my friends *******//
        $postsWeb = $em->getRepository('SocialProNetworkBundle:PostsWeb')->friendsPostsDQL($id);
//***********************************************//

        $likers = $em->getRepository('SocialProNetworkBundle:PostWebReaction')->findBy(array('iduser'=>$this->getUser()->getId()));
//******* get all the comments *******//
        $comments = $em->getRepository('SocialProNetworkBundle:CommentsWeb')->findAll();


        $peoplz = $em->getRepository('SocialProNetworkBundle:Relations')->findAll();

//******* creat comment form *******//
        $formComment = new CommentsWeb();
        $form = $this->createForm('SocialPro\NetworkBundle\Form\CommentsWebType', $formComment);
        $form->handleRequest($request);

//******* get all the posts of my friends *******//
        $formPost = new PostsWeb();
        $formP = $this->createForm('SocialPro\NetworkBundle\Form\PostsWebType',$formPost);
        $formP->handleRequest($request);

        if ($formP->isSubmitted() && $formP->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $formPost->setDateinsert(new \DateTime());
            $formPost->setIduser($this->getUser());
            $formPost->setModified("FALSE");
            $em->persist($formPost);
            $em->flush();

            return $this->redirectToRoute('posts_index');
        }

//****************
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $formComment->setDatepublished(new \DateTime());
            $formComment->setIduser($this->getUser());
            $formComment->setModified(false);


            $em->persist($formComment);
            $em->flush();

            return $this->redirectToRoute('posts_index');
        }

//********************************************/


        return $this->render('Accueil/index.html.twig', array(
            'peoplz' => $peoplz,
            'postsWeb' => $postsWeb,
            'comments'=> $comments,
            'formPost'=>$formPost,
            'likers'=>$likers,
            'form' => $form->createView(),
            'formP' => $formP->createView(),
        ));



    }

    public function likeAction($id)
    {


        $like = new PostWebReaction();
        $like->setIduser($this->getUser()->getId());
        $like->setIdpost($id);
        $like->setDate(new \DateTime());
        $this->getDoctrine()->getManager()->persist($like);
        $this->getDoctrine()->getManager()->flush();

        $em = $this->getDoctrine()->getManager();
        $reactions = $em->getRepository('SocialProNetworkBundle:PostWebReaction')->findBy(array('idpost'=>$id));
        $likes = count($reactions);
        return new Response($likes);
    }
    public function dislikeAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $dislike = $em->getRepository('SocialProNetworkBundle:PostWebReaction')->findOneBy(array('idpost'=>$id,'iduser'=>$this->getUser()));
        $em->remove($dislike);
        $em->flush();


        $reactions = $em->getRepository('SocialProNetworkBundle:PostWebReaction')->findBy(array('idpost'=>$id));
        $likes = count($reactions);
        return new Response($likes);
    }

    public function addCommentAction($id,$content )
    {
        $em = $this->getDoctrine()->getManager();
        $comment = new CommentsWeb();
        $post = $em->getRepository('SocialProNetworkBundle:PostsWeb')->findOneBy(array('idPo'=>$id));

        $comment->setComment($content);
        $comment->setIduser($this->getUser());
        $comment->setIdpost($post);
        $comment->setDatepublished(new \DateTime());
        $em->persist($comment);

        $em->flush();


        return new Response($comment);

    }
        public function deleteCommentAction ($id)
        {
            $em = $this->getDoctrine()->getManager();

            $comment = $em->getRepository('SocialProNetworkBundle:CommentsWeb')->findOneBy(array('idCo'=>$id));
            $em->remove($comment);
            $em->flush();
            return new Response();

        }
    public function editCommentAction ($id,$content)
    {
        $em = $this->getDoctrine()->getManager();

        $comment = $em->getRepository('SocialProNetworkBundle:CommentsWeb')->findOneBy(array('idCo'=>$id));
        $comment->setModified(true);
        $comment->setComment($content);
        $comment->setDatemodification(new \DateTime());

        $em->flush();
        return new Response($comment);

    }

    public function deletePostAction ($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('SocialProNetworkBundle:PostsWeb')->findOneBy(array('idPo'=>$id));
        $em->remove($post);
        $em->flush();
        return new Response();

    }
    public function editPostAction ($id,$content)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('SocialProNetworkBundle:PostsWeb')->findOneBy(array('idPo'=>$id));
        $post->setModified(true);
        $post->setContenu($content);
        $post->setDatemodification(new \DateTime());

        $em->flush();
        return new Response($post);

    }

    public function displayAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('SocialProNetworkBundle:Users')->findOneBy(array('id'=>$id));

        $CV = $em->getRepository('SocialProNetworkBundle:CurriculaVitae')->findBy(array('iduser'=>$id),array('datefrom'=>'desc'));

        $following = $em->getRepository('SocialProNetworkBundle:Relations')->findBy(array('iduser'=>$id));
        $nbr = count($following);
        $followers = $em->getRepository('SocialProNetworkBundle:Relations')->findBy(array('idfriend'=>$id));
        $nbrz = count($followers);


        return $this->render('Accueil/user.html.twig', array(
            'user' => $user,
            'cv'=>$CV,
            'friends'=>$following,
            'following'=>$nbr,
            'followers'=>$nbrz,

        ));
    }


    public function followAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('SocialProNetworkBundle:Users')->findOneBy(array('id'=>$id));
        $relation = new Relations();

        $relation->setIduser($this->getUser());
        $relation->setIdfriend($user);

        $em->persist($relation);
        $em->flush();
        return new Response();


    }

    public function unfollowAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('SocialProNetworkBundle:Users')->findOneBy(array('id'=>$id));
        $r = $em->getRepository('SocialProNetworkBundle:Relations')->findOneBy(array('idfriend'=>$user,'iduser'=>$this->getUser()));

        $em->remove($r);
        $em->flush();
        return new Response();


    }

}