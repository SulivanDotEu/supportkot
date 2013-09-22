<?php

namespace Walva\SupportkotBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Walva\SupportkotBundle\Entity\Parrain;
use Walva\SupportkotBundle\Form\ParrainType;

/**
 * Parrain controller.
 *
 */
class ParrainController extends Controller {

    /**
     * Lists all Parrain entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WalvaSupportkotBundle:Parrain')->findAll();

        return $this->render('WalvaSupportkotBundle:Parrain:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Parrain entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Parrain();
        $form = $this->createForm(new ParrainType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('parrain_show', array('id' => $entity->getId())));
        }

        return $this->render('WalvaSupportkotBundle:Parrain:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Parrain entity.
     *
     */
    public function newAction() {
        $entity = new Parrain();
        $form = $this->createForm(new ParrainType(), $entity);

        return $this->render('WalvaSupportkotBundle:Parrain:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Parrain entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Parrain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parrain entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaSupportkotBundle:Parrain:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Parrain entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Parrain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parrain entity.');
        }

        $editForm = $this->createForm(new ParrainType(), $entity);
        $editForm->add('filleuls', 'entity', array(
            'class' => 'WalvaSupportkotBundle:Filleul',
            'multiple' => 'true',
            'expanded' => true,
            'required' => false
        ));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaSupportkotBundle:Parrain:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Parrain entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Parrain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parrain entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ParrainType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('parrain_edit', array('id' => $id)));
        }

        return $this->render('WalvaSupportkotBundle:Parrain:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Parrain entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WalvaSupportkotBundle:Parrain')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Parrain entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('parrain'));
    }

    /**
     * Creates a form to delete a Parrain entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
