<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Doc;
use Admin\AdminBundle\Form\DocType;

/**
 * Doc controller.
 *
 */
class DocController extends Controller
{

    /**
     * Lists all Doc entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Doc')->findAll();

        return $this->render('AdminBundle:Doc:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Doc entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Doc();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            //ajoute image physique
            $file = $form->get('image')->getNormData();
            $name = $entity->getImageName();
            $id = $entity->getId();
            if(null !== $file) {               
                $fileName =$name.'_'.uniqid().'.'.$file->guessExtension();
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/autres';
                $file->move($imagesDir, $fileName);
                $entity->setImage($fileName);
                $entity->setImageName($fileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('doc', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Doc:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Doc entity.
     *
     * @param Doc $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Doc $entity)
    {
        $form = $this->createForm(new DocType(), $entity, array(
            'action' => $this->generateUrl('doc_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
		'label' => 'AJOUTER',
		'attr'  => array('class' => 'btn btn-info')
	));

        return $form;
    }

    /**
     * Displays a form to create a new Doc entity.
     *
     */
    public function newAction()
    {
        $entity = new Doc();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Doc:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Doc entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Doc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doc entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Doc:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Doc entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Doc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doc entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Doc:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Doc entity.
    *
    * @param Doc $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Doc $entity)
    {
        $form = $this->createForm(new DocType(), $entity, array(
            'action' => $this->generateUrl('doc_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
		'label' => 'MODIFIER',
		'attr' => array('class'=>'btn btn-warning','disabled'=>'disabled'),
	));

        return $form;
    }
    /**
     * Edits an existing Doc entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Doc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doc entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if ($editForm->isSubmitted()) {
                
                //recup nom image avant modif
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/autres';               
                $oldFileName = $em->getRepository('AdminBundle:Doc')->getFileNames($id);
                $old=$oldFileName[0]->getImageName();                
                

                $file = $editForm->get('image')->getData();

                if(null !== $file){
                    if(null !== $old){
                        unlink($imagesDir.'/'.$old);
                    }                   
                    $fileName = $name.'_'.uniqid().'.'.$file->guessExtension();
                    $file->move($imagesDir, $fileName);
                    $entity->setImage($fileName);
                    $entity->setImageName($fileName);
                }else{
                    $entity->setImage($old);
                }
                
               
                
            }
            $em->flush();

            return $this->redirect($this->generateUrl('doc_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:Doc:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Doc entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Doc')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Doc entity.');
            }

            //efface image physique
            $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/autres';               
            $oldFileName = $em->getRepository('AdminBundle:Doc')->getFileNames($id);
            $old=$oldFileName[0]->getImageName();
            if(null !== $old){
                unlink($imagesDir.'/'.$old);
            }                
            
            //efface entity
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('doc'));
    }

    /**
     * Creates a form to delete a Doc entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('doc_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
		'label' => 'SUPPRIMER',
		'attr' => array('class'=>'btn btn-danger'),
		))
            ->getForm()
        ;
    }
}
