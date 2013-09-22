<?php

namespace Walva\PublicationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Walva\PublicationBundle\Entity\Article;
use Walva\PublicationBundle\Form\ArticleType;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller {

    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WalvaPublicationBundle:Article')
                ->findBy(
                array('epingle' => true), array('dateCreation' => 'DESC')
        );

        return $this->render('WalvaPublicationBundle:Article:list.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Lists all Article entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();



        if (true === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $entities = $em->getRepository('WalvaPublicationBundle:Article')->findAll();
            return $this->render('WalvaPublicationBundle:Article:index.html.twig', array(
                        'entities' => $entities,
            ));
        } else {
            $entities = $em->getRepository('WalvaPublicationBundle:Article')->findBy(
                    array('published' => true), array('dateCreation' => 'DESC')
            );
            return $this->render('WalvaPublicationBundle:Article:public/index.html.twig', array(
                        'entities' => $entities,
            ));
        }
    }

    /**
     * Creates a new Article entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Article();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $entity->getId())));
        }

        return $this->render('WalvaPublicationBundle:Article:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Article entity.
     *
     * @param Article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Article $entity) {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction() {
        $entity = new Article();
        $form = $this->createCreateForm($entity);
        
        return $this->render('WalvaPublicationBundle:Article:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaPublicationBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        if (true === $this->get('security.context')->isGranted('ROLE_ADMIN')) {

            return $this->render('WalvaPublicationBundle:Article:show.html.twig', array(
                        'entity' => $entity,
                        'delete_form' => $deleteForm->createView(),));
        } else {
            return $this->render('WalvaPublicationBundle:Article:public/show.html.twig', array('entity' => $entity,));
        }
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showBySlugAction($slug) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaPublicationBundle:Article')->findBySlug($slug)[0];

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        if (true === $this->get('security.context')->isGranted('ROLE_ADMIN')) {

            return $this->render('WalvaPublicationBundle:Article:show.html.twig', array(
                        'entity' => $entity,
            ));
        } else {
            return $this->render('WalvaPublicationBundle:Article:public/show.html.twig', array('entity' => $entity,));
        }
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaPublicationBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createEditForm($entity);

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WalvaPublicationBundle:Article:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Article entity.
     *
     * @param Article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Article $entity) {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('article_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        /*
          $form->remove('image');
          $form->add('image', 'entity', array(
          'class' => 'WalvaPublicationBundle:Image',
          'multiple' => false,
          'required' => false
          ));
         */
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Article entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WalvaPublicationBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('article_show', array('id' => $id)));
        }

        return $this->render('WalvaPublicationBundle:Article:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WalvaPublicationBundle:Article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a Article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('article_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete',
                            'attr' => array('class' => 'btn')))
                        ->getForm()
        ;
    }

}
