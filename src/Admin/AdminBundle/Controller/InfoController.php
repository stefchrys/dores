<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Info;
use Admin\AdminBundle\Form\InfoType;

/**
 * Info controller.
 *
 */
class InfoController extends Controller
{

    /**
     * Lists all Info entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('AdminBundle:Info')->findAll();
        $entities = $em->getRepository('AdminBundle:Info')->findBy(array(),array('categorie'=>'asc'));

        return $this->render('AdminBundle:Info:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Info entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Info();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('info_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Info:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Info entity.
     *
     * @param Info $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Info $entity)
    {
        $form = $this->createForm(new InfoType(), $entity, array(
            'action' => $this->generateUrl('info_create'),
            'method' => 'POST',
        ));

         $form->add('submit', 'submit', array(
            'label' => 'AJOUTER',
            'attr' => array('class' => 'btn btn-info'),
            ));

        return $form;
    }

    /**
     * Displays a form to create a new Info entity.
     *
     */
    public function newAction()
    {
        $entity = new Info();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Info:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Info entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Info')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Info entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Info:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Info entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Info')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Info entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Info:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Info entity.
    *
    * @param Info $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Info $entity)
    {
        $form = $this->createForm(new InfoType(), $entity, array(
            'action' => $this->generateUrl('info_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

         $form->add('submit', 'submit', array(
            'label' => 'MODIFIER',
            'attr' => array('class' => 'btn btn-warning'),
            ));

        return $form;
    }
    /**
     * Edits an existing Info entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Info')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Info entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('info'));
        }

        return $this->render('AdminBundle:Info:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Info entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Info')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Info entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('info'));
    }

    /**
     * Creates a form to delete a Info entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('info_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'SUPPRIMER  ',
                'attr' => array('class' => 'btn btn-danger'),
                ))
            ->getForm()
        ;
    }
}
