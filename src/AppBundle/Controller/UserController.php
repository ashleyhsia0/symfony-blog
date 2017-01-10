<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * User controller.
 *
 * @Route("users")
 */
class UserController extends Controller
{
    /**
     * Shows the blog index for a user.
     *
     * @Route("/{username}", name="user_blog_index")
     * @Method("GET")
     */
    public function indexAction($username)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->findOneByUsername($username);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found with this username: '.$username
            );
        }

        // $user_id = $user->getId();
        // $posts = $em->getRepository('AppBundle:Post')->findBy(array('author' => $user_id));
        $posts = $user->getPosts();

        return $this->render('user/index.html.twig', array(
            'posts' => $posts,
            'user' => $user
        ));
    }
}
