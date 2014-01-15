<?php

namespace SympleBlog\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use SympleBlog\UserBundle\Entity\Post as Post;

class DefaultController extends Controller {

    /**
     * @Route("/") 
     * @Template()
     */
    public function wallAction() {
        $securityContext = $this->get('security.context');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->getRequest()->getSession()->setFlash("notloggedin", "You must be logged in to access your wall");
            return $this->forward("FOSUserBundle:Security:login");
        }
        
        $user = $securityContext->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        
        if($this->getRequest()->getMethod() == "POST") {
            // Process form validation
            $post = new Post();
            $post->setDate(new \DateTime());
            $post->setMessage($this->getRequest()->request->get("message"));
            $post->setUser($user);
            $em->persist($post);
            $em->flush();
        }
        
        // Display page
        $query = $em->createQuery("select p from SympleBlog\UserBundle\Entity\Post p where p.user = :user");
        $query->setParameter("user", $user);
        $posts = $query->execute();
        return array("posts" => $posts);
    }

}
