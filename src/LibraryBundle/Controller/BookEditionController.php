<?php

namespace LibraryBundle\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LibraryBundle\Entity\BookEdition;
use LibraryBundle\Form\BookEditionType;

/**
 * BookEdition controller.
 *
 * @Route("/bookedition")
 */
class BookEditionController extends Controller
{

    /**
     * Lists all BookEdition entities.
     *
     * @Route("/", name="bookedition")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LibraryBundle:BookEdition')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BookEdition entity.
     *
     * @Route("/", name="bookedition_create")
     * @Method("POST")
     * @Template("LibraryBundle:BookEdition:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BookEdition();
        $entity->setReleaseDate(new DateTime());
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bookedition_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a BookEdition entity.
     *
     * @param BookEdition $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BookEdition $entity)
    {
        $form = $this->createForm(new BookEditionType(), $entity, array(
            'action' => $this->generateUrl('bookedition_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BookEdition entity.
     *
     * @Route("/new", name="bookedition_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BookEdition();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BookEdition entity.
     *
     * @Route("/{id}", name="bookedition_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:BookEdition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookEdition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BookEdition entity.
     *
     * @Route("/{id}/edit", name="bookedition_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:BookEdition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookEdition entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a BookEdition entity.
    *
    * @param BookEdition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BookEdition $entity)
    {
        $form = $this->createForm(new BookEditionType(), $entity, array(
            'action' => $this->generateUrl('bookedition_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BookEdition entity.
     *
     * @Route("/{id}", name="bookedition_update")
     * @Method("PUT")
     * @Template("LibraryBundle:BookEdition:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:BookEdition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookEdition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bookedition_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BookEdition entity.
     *
     * @Route("/{id}", name="bookedition_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LibraryBundle:BookEdition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BookEdition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bookedition'));
    }

    /**
     * Creates a form to delete a BookEdition entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bookedition_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
