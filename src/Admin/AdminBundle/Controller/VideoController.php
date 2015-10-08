<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Video;
use Admin\AdminBundle\Form\VideoType;

/**
 * Video controller.
 *
 */
class VideoController extends Controller
{

    /**
     * Lists all Video entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('AdminBundle:Video')->findAll();
        $entities = $em->getRepository('AdminBundle:Video')->findBy(array(),array('categorie'=>'asc'));

        return $this->render('AdminBundle:Video:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Video entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Video();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
             //ajoute video physique
            $file = $form->get('source')->getNormData();
            if($file != null) {                
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/video';
                $file->move($imagesDir, $fileName);
                $entity->setSource($fileName);
                $entity->setSourceName($fileName);
            }
            //persist
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('video', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Video:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Video entity.
     *
     * @param Video $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Video $entity)
    {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('video_create'),
            'method' => 'POST',
        ));

         $form->add('submit', 'submit', array(
            'label' => 'AJOUTER',
            'attr' => array('class' => 'btn btn-info'),
            ));

        return $form;
    }

    /**
     * Displays a form to create a new Video entity.
     *
     */
    public function newAction()
    {
        $entity = new Video();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Video:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Video entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Video:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Video entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Video:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Video entity.
    *
    * @param Video $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Video $entity)
    {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('video_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'MODIFIER',
            'attr' => array('class' => 'btn btn-warning'),
            ));

        return $form;
    }
    /**
     * Edits an existing Video entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
         //recuperation de entity dans bdd
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);


        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
                
            if ($editForm->isSubmitted()) {
                
                //recup nom image avant modif
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/video';               
                $oldFileName = $em->getRepository('AdminBundle:Video')->getFileNames($id);
                $old=$oldFileName[0]->getSourceName();                
                

                $file = $editForm->get('source')->getData();

                if($file != null){
                    if($old !=null){
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
    
            return $this->redirect($this->generateUrl('video'));
        }

        return $this->render('AdminBundle:Video:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Video entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Video')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find video entity.');
            }

            //efface video physique
            $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/video';               
            $oldFileName = $em->getRepository('AdminBundle:Video')->getFileNames($id);
            $old=$oldFileName[0]->getSourceName();                
            if($old !=null){
                unlink($imagesDir.'/'.$old);
            } 
            //efface entity
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('video'));
    }

    /**
     * Creates a form to delete a Video entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('video_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'SUPPRIMER  ',
                'attr' => array('class' => 'btn btn-danger'),
                ))
            ->getForm()
        ;
    }
}
