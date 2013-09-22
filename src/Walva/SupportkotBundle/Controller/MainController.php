<?php

namespace Walva\SupportkotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Walva\SupportkotBundle\Plugin\ObjectComparator;

class MainController extends Controller {

    public function indexAction() {
        return $this->redirect($this->generateUrl('article_show_by_slug', array('slug' => 'home')));
    }

    public function associationsAction() {
        $em = $this->getDoctrine()->getManager();
        $facs = $em->getRepository('WalvaSupportkotBundle:Fac')->findAll();
        $array = array();
        foreach ($facs as $fac) {
            $entities = $em->getRepository('WalvaSupportkotBundle:Parrain')
                    ->findByFaculte($fac);
            $array[$fac->getNom()] = $entities;
        }
        

        return $this->render('WalvaSupportkotBundle:Parrain:associations.html.twig', array(
                    'array' => $array,
        ));
    }

}
