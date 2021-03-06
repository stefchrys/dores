<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Whois;
use Admin\AdminBundle\Form\WhoisType;

/**
 * Whois controller.
 *
 */
class WhoisController extends Controller
{

    /**
     * Lists all Whois entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Whois')->findAll();

        return $this->render('AdminBundle:Whois:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Whois entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Whois();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('whois', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Whois:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Whois entity.
     *
     * @param Whois $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Whois $entity)
    {
        $form = $this->createForm(new WhoisType(), $entity, array(
            'action' => $this->generateUrl('whois_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'AJOUTER',
            'attr' => array('class' => 'btn btn-info'),
            ));

        return $form;
    }

    /**
     * Displays a form to create a new Whois entity.
     *
     */
    public function newAction()
    {
        $entity = new Whois();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Whois:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Whois entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Whois')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Whois entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Whois:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Whois entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Whois')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Whois entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Whois:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Whois entity.
    *
    * @param Whois $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Whois $entity)
    {
        $form = $this->createForm(new WhoisType(), $entity, array(
            'action' => $this->generateUrl('whois_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'MODIFIER',
            'attr' => array('class' => 'btn btn-warning'),
            ));

        return $form;
    }
    /**
     * Edits an existing Whois entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Whois')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Whois entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('whois'));
        }

        return $this->render('AdminBundle:Whois:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Whois entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Whois')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Whois entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('whois'));
    }

    /**
     * Creates a form to delete a Whois entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('whois_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'SUPPRIMER',
                'attr' => array('class' => 'btn btn-danger'),
                ))
            ->getForm()
        ;
    }
}
