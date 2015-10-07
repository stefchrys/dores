<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Footer;
use Admin\AdminBundle\Form\FooterType;

/**
 * Footer controller.
 *
 */
class FooterController extends Controller
{

    /**
     * Lists all Footer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Footer')->findAll();

        return $this->render('AdminBundle:Footer:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Footer entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Footer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('footer_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Footer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Footer entity.
     *
     * @param Footer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Footer $entity)
    {
        $form = $this->createForm(new FooterType(), $entity, array(
            'action' => $this->generateUrl('footer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Footer entity.
     *
     */
    public function newAction()
    {
        $entity = new Footer();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Footer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Footer entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Footer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Footer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Footer:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Footer entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Footer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Footer entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Footer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Footer entity.
    *
    * @param Footer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Footer $entity)
    {
        $form = $this->createForm(new FooterType(), $entity, array(
            'action' => $this->generateUrl('footer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

       $form->add('submit', 'submit', array(
            'label' => 'MODIFIER',
            'attr' => array('class' => 'btn btn-warning'),
            ));

        return $form;
    }
    /**
     * Edits an existing Footer entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Footer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Footer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('footer'));
        }

        return $this->render('AdminBundle:Footer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Footer entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Footer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Footer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('footer'));
    }

    /**
     * Creates a form to delete a Footer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('footer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
