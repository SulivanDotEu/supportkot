<?php

namespace Walva\SupportkotBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Walva\SupportkotBundle\Entity\Annee;
use Walva\SupportkotBundle\Form\AnneeType;

/**
 * Annee controller.
 *
 */
class AnneeController extends Controller
{

    /**
     * Lists all Annee entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WalvaSupportkotBundle:Annee')->findAll();

        return $this->render('WalvaSupportkotBundle:Annee:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Annee entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Annee();
        $form = $this->createForm(new AnneeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('annee_show', array('id' => $entity->getId())));
        }

        return $this->render('WalvaSupportkotBundle:Annee:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Annee entity.
     *
     */
    public function newAction()
    {
        $entity = new Annee();
        $form   = $this->createForm(new AnneeType(), $entity);

        return $this->render('WalvaSupportkotBundle:Annee:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Annee entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Annee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaSupportkotBundle:Annee:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Annee entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Annee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annee entity.');
        }

        $editForm = $this->createForm(new AnneeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaSupportkotBundle:Annee:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Annee entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaSupportkotBundle:Annee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AnneeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('annee_edit', array('id' => $id)));
        }

        return $this->render('WalvaSupportkotBundle:Annee:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Annee entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WalvaSupportkotBundle:Annee')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Annee entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('annee'));
    }

    /**
     * Creates a form to delete a Annee entity by id.
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
