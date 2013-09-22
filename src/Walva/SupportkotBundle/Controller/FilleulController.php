<?php

namespace Walva\SupportkotBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Walva\SupportkotBundle\Entity\Filleul;
use Walva\SupportkotBundle\Form\FilleulType;
use \Walva\NatagoraBundle\Plugin\ObjectComparator;

/**
 * Filleul controller.
 *
 */
class FilleulController extends Controller {

    /**
     * Lists all Filleul entities.
     *
     */
    public function indexAction($sort = null, $order = 'ASC') {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WalvaSupportkotBundle:Filleul')->findAll();
        if ($sort != null) {
            $comparator = new ObjectComparator();
            $entities = $comparator->sort($entities, $sort, $order);
        }
        
        return $this->render('WalvaSupportkotBundle:Filleul:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Filleul entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Filleul();
        $form = $this->createForm(new FilleulType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('filleul_show', array('id' => $entity->getId())));
        }

        return $this->render('WalvaSupportkotBundle:Filleul:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Filleul entity.
     *
     */
    public function newAction() {
        $entity = new Filleul();
        $form = $this->createForm(new FilleulType(), $entity);

        return $this->render('WalvaSupportkotBundle:Filleul:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Filleul entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Filleul')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Filleul entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaSupportkotBundle:Filleul:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Filleul entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Filleul')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Filleul entity.');
        }

        $editForm = $this->createForm(new FilleulType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaSupportkotBundle:Filleul:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Filleul entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Filleul')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Filleul entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FilleulType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('filleul_edit', array('id' => $id)));
        }

        return $this->render('WalvaSupportkotBundle:Filleul:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Filleul entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WalvaSupportkotBundle:Filleul')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Filleul entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('filleul'));
    }

    /**
     * Creates a form to delete a Filleul entity by id.
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
