<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Accueil;
use Admin\AdminBundle\Form\AccueilType;

/**
 * Accueil controller.
 *
 */
class AccueilController extends Controller
{

    /**
     * Lists all Accueil entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Accueil')->findAll();

        return $this->render('AdminBundle:Accueil:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Accueil entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Accueil();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('accueil_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Accueil:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Accueil entity.
     *
     * @param Accueil $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Accueil $entity)
    {
        $form = $this->createForm(new AccueilType(), $entity, array(
            'action' => $this->generateUrl('accueil_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Accueil entity.
     *
     */
    public function newAction()
    {
        $entity = new Accueil();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Accueil:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Accueil entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Accueil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accueil entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Accueil:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Accueil entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Accueil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accueil entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Accueil:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Accueil entity.
    *
    * @param Accueil $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Accueil $entity)
    {
        $form = $this->createForm(new AccueilType(), $entity, array(
            'action' => $this->generateUrl('accueil_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'MODIFIER',
            'attr' => array('class' => 'btn btn-warning'),
            ));

        return $form;
    }
    /**
     * Edits an existing Accueil entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Accueil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accueil entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('accueil'));
        }

        return $this->render('AdminBundle:Accueil:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Accueil entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Accueil')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Accueil entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('accueil'));
    }

    /**
     * Creates a form to delete a Accueil entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accueil_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
