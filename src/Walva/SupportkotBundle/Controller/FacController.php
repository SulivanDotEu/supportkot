<?php

namespace Walva\SupportkotBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Walva\SupportkotBundle\Entity\Fac;
use Walva\SupportkotBundle\Form\FacType;

/**
 * Fac controller.
 *
 */
class FacController extends Controller
{

    /**
     * Lists all Fac entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WalvaSupportkotBundle:Fac')->findAll();

        return $this->render('WalvaSupportkotBundle:Fac:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Fac entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Fac();
        $form = $this->createForm(new FacType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fac_show', array('id' => $entity->getId())));
        }

        return $this->render('WalvaSupportkotBundle:Fac:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Fac entity.
     *
     */
    public function newAction()
    {
        $entity = new Fac();
        $form   = $this->createForm(new FacType(), $entity);

        return $this->render('WalvaSupportkotBundle:Fac:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fac entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Fac')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fac entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaSupportkotBundle:Fac:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Fac entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Fac')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fac entity.');
        }

        $editForm = $this->createForm(new FacType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaSupportkotBundle:Fac:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Fac entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Fac')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fac entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FacType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fac_edit', array('id' => $id)));
        }

        return $this->render('WalvaSupportkotBundle:Fac:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Fac entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WalvaSupportkotBundle:Fac')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fac entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fac'));
    }

    /**
     * Creates a form to delete a Fac entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
