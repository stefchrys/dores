<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Audio;
use Admin\AdminBundle\Form\AudioType;

/**
 * Audio controller.
 *
 */
class AudioController extends Controller
{

    /**
     * Lists all Audio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AdminBundle:Audio')->findBy(array(),array('categorie'=>'asc'));

        return $this->render('AdminBundle:Audio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Audio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Audio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
             //ajoute audio physique
            $file = $form->get('source')->getNormData(); 
            if(null !== $file ) {               
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/audio';
                $file->move($imagesDir, $fileName);
                $entity->setSource($fileName);
                $entity->setSourceName($fileName);
            }
            //persist
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('audio', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Audio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Audio entity.
     *
     * @param Audio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Audio $entity)
    {
        $form = $this->createForm(new AudioType(), $entity, array(
            'action' => $this->generateUrl('audio_create'),
            'method' => 'POST',
        ));

       $form->add('submit', 'submit', array(
            'label' => 'AJOUTER',
            'attr' => array('class' => 'btn btn-info'),
            ));

        return $form;
    }

    /**
     * Displays a form to create a new Audio entity.
     *
     */
    public function newAction()
    {
        $entity = new Audio();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Audio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Audio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Audio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Audio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Audio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Audio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Audio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Audio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Audio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Audio entity.
    *
    * @param Audio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Audio $entity)
    {
        $form = $this->createForm(new AudioType(), $entity, array(
            'action' => $this->generateUrl('audio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

         $form->add('submit', 'submit', array(
            'label' => 'MODIFIER',
            'attr' => array('class' => 'btn btn-warning'),
            ));

        return $form;
    }
    /**
     * Edits an existing Audio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        //recuperation de entity dans bdd
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminBundle:Audio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Audio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);


        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
                
            if ($editForm->isSubmitted()) {
                
                //recup nom image avant modif
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/audio';               
                $oldFileName = $em->getRepository('AdminBundle:Audio')->getFileNames($id);
                $old=$oldFileName[0]->getSourceName();                
                

                $file = $editForm->get('source')->getData();

                if(null !== $file ){
                    if(null !== $old){
                        unlink($imagesDir.'/'.$old);
                    }                   
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($imagesDir, $fileName);
                    $entity->setSource($fileName);
                    $entity->setSourceName($fileName);
                }else{
                    $entity->setSource($old);
                }
                
               
                
            }
            $em->flush();    
    
            return $this->redirect($this->generateUrl('audio'));
        }

        return $this->render('AdminBundle:Audio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Audio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Audio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Audio entity.');
            }

            //efface audio physique
            $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/audio';               
            $oldFileName = $em->getRepository('AdminBundle:Audio')->getFileNames($id);
            $old=$oldFileName[0]->getSourceName();                
            if(null !== $old){
                unlink($imagesDir.'/'.$old);
            } 
            //efface entity
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('audio'));
    }

    /**
     * Creates a form to delete a Audio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('audio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'SUPPRIMER  ',
                'attr' => array('class' => 'btn btn-danger'),
                ))
            ->getForm()
        ;
    }
}
