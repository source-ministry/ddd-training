<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\BookCopy;
use LibraryBundle\Form\BookCopyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * BookCopy controller.
 */
class BookCopyController extends Controller
{

    /**
     * Lists all BookCopy entities.
     *
     * @Route("/", name="bookcopy")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LibraryBundle:BookCopy')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new BookCopy entity.
     *
     * @Route("/bookcopy/", name="bookcopy_create")
     * @Method("POST")
     * @Template("LibraryBundle:BookCopy:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BookCopy();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bookcopy_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a BookCopy entity.
     *
     * @param BookCopy $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BookCopy $entity)
    {
        $form = $this->createForm(new BookCopyType(), $entity, array(
            'action' => $this->generateUrl('bookcopy_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BookCopy entity.
     *
     * @Route("/bookcopy/new", name="bookcopy_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $entity = new BookCopy();
        $entity->setAddedToLibraryAt(new \DateTime());
        if ($request->query->has('editionId')) {
            $entity->setEdition($this->getDoctrine()->getManager()->getRepository('LibraryBundle:BookEdition')->find($request->query->get('editionId')));
        }
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a BookCopy entity.
     *
     * @Route("/bookcopy/{id}", name="bookcopy_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:BookCopy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookCopy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BookCopy entity.
     *
     * @Route("/bookcopy/{id}/edit", name="bookcopy_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:BookCopy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookCopy entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a BookCopy entity.
     *
     * @param BookCopy $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(BookCopy $entity)
    {
        $form = $this->createForm(new BookCopyType(), $entity, array(
            'action' => $this->generateUrl('bookcopy_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing BookCopy entity.
     *
     * @Route("/bookcopy/{id}", name="bookcopy_update")
     * @Method("PUT")
     * @Template("LibraryBundle:BookCopy:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:BookCopy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookCopy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bookcopy_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a BookCopy entity.
     *
     * @Route("/bookcopy/{id}", name="bookcopy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LibraryBundle:BookCopy')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BookCopy entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bookcopy'));
    }

    /**
     * Creates a form to delete a BookCopy entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bookcopy_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
