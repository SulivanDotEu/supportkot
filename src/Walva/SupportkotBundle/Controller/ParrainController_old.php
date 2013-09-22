<?php

namespace Walva\SupportkotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Walva\SupportkotBundle\Entity\Parrain;
use Walva\SupportkotBundle\Form\ParrainType;

class ParrainController extends Controller {

    public function indexAction($name) {
        return $this->render('WalvaSupportkotBundle:Supportkot:index.html.twig', array('name' => $name));
    }

    public function listAction() {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('WalvaSupportkotBundle:Parrain');

        $objects = $repository->findAll();
        return $this->render('WalvaSupportkotBundle:parrain:list.html.twig', array('objects' => $objects));
    }

    public function createAction() {

        date_default_timezone_set("Europe/Brussels");
        $objet = new Parrain();
        $form = $this->createForm(new ParrainType(), $objet);
        
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($objet);
                $em->flush();
                return $this->redirect($this->generateUrl('walva_supportkot_parrain_read', array('id' => $objet->getId())));
            }
        }

        return $this->render('WalvaSupportkotBundle:parrain:create.html.twig', array(
                    'form' => $form->createView()
                ));
    }

    public function deleteAction() {
        
    }

    public function readAction(Parrain $parrain) {
        return $this->render('WalvaSupportkotBundle:parrain:read.html.twig', array('objet' => $parrain));
    }

    public function updateAction(Parrain $parrain) {
        
    }

}
