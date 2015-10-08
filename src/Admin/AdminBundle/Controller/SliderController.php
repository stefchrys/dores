<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Slider;
use Admin\AdminBundle\Form\SliderType;

/**
 * Slider controller.
 *
 */
class SliderController extends Controller
{

    /**
     * Lists all Slider entities.
     *
     */
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('AdminBundle:Slider')->findAll();
        $entities = $em->getRepository('AdminBundle:Slider')->findBy(array(),array('source'=>'asc'));

        return $this->render('AdminBundle:Slider:index.html.twig', array(
            'entities' => $entities,
        ));
        
    }
    /**
     * Creates a new Slider entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Slider();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

       if ($form->isValid()) {
             //ajoute audio physique
            $file = $form->get('source')->getNormData();                
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/img/slider';
            $file->move($imagesDir, $fileName);
            $entity->setSource($fileName);
            $entity->setSourceName($fileName);

            //persist
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('slider_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Slider:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Slider entity.
     *
     * @param Slider $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Slider $entity)
    {
        $form = $this->createForm(new SliderType(), $entity, array(
            'action' => $this->generateUrl('slider_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'AJOUTER',
            'attr' => array('class' => 'btn btn-info'),
            ));

        return $form;
    }

    /**
     * Displays a form to create a new Slider entity.
     *
     */
    public function newAction()
    {
        $entity = new Slider();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Slider:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Slider entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Slider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Slider:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Slider entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Slider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slider entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Slider:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Slider entity.
    *
    * @param Slider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Slider $entity)
    {
        $form = $this->createForm(new SliderType(), $entity, array(
            'action' => $this->generateUrl('slider_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'MODIFIER',
            'attr' => array('class' => 'btn btn-warning'),
            ));

        return $form;
    }
    /**
     * Edits an existing Slider entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Slider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
         //efface ancien fichier
            $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/img/slider';               
            $oldFileName = $em->getRepository('AdminBundle:Slider')->getFileNames($id);
            $old=$oldFileName[0]->getSourceName();                
            unlink($imagesDir.'/'.$old);
        $editForm->handleRequest($request);

       if ($editForm->isValid()) {
           

            if ($editForm->isSubmitted()) {
                $file = $editForm->get('source')->getData();
                
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($imagesDir, $fileName);
                $entity->setSource($fileName);
                $entity->setSourceName($fileName);
            }
            $em->flush();    
    
            return $this->redirect($this->generateUrl('slider'));
        }

        return $this->render('AdminBundle:Slider:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

    }
    /**
     * Deletes a Slider entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Slider')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Slider entity.');
            }
             //efface slider physique
            $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/img/slider';               
            $oldFileName = $em->getRepository('AdminBundle:Slider')->getFileNames($id);
            $old=$oldFileName[0]->getSourceName();                
            unlink($imagesDir.'/'.$old);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('slider'));
    }

    /**
     * Creates a form to delete a Slider entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('slider_delete', array('id' => $id)))
            ->setMethod('DELETE')
             ->add('submit', 'submit', array(
                'label' => 'SUPPRIMER  ',
                'attr' => array('class' => 'btn btn-danger'),
                ))
            ->getForm()
        ;
    }
}
