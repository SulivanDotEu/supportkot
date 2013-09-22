<?php

namespace Walva\SupportkotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjetsController extends Controller
{
    public function indexAction($name)
    {
        return $this->redirect($this->generateUrl('article_show_by_slug', array('slug' => 'home')));
    }
    
    public function welcomeDayAction(){
        return $this->render('WalvaSupportkotBundle:Supportkot:welcome_day.html.twig', array());
    }
    
    public function methodoAction(){
        return $this->render('WalvaSupportkotBundle:Supportkot:methodo.html.twig', array());
    }
}
