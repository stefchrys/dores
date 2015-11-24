<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\AdminBundle\Entity\Livres;
use Admin\AdminBundle\Form\LivresType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Livres controller.
 *
 */
class LivresController extends Controller
{

    /**
     * Lists all Livres entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('AdminBundle:Livres')->findAll();
        $entities = $em->getRepository('AdminBundle:Livres')->findBy(array(),array('titre'=>'asc'));

        return $this->render('AdminBundle:Livres:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Livres entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Livres();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            //ajoute image physique
            $file = $form->get('image')->getNormData();
            if(null !== $file ) {               
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/img/collection';
                $file->move($imagesDir, $fileName);
                $entity->setImage($fileName);
                $entity->setImageName($fileName);
            }
            //persiste l'entité
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('livres', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Livres:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Livres entity.
     *
     * @param Livres $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Livres $entity)
    {
        $form = $this->createForm(new LivresType(), $entity, array(
            'action' => $this->generateUrl('livres_create'),
            'method' => 'POST',
        ));

         $form->add('submit', 'submit', array(
            'label' => 'AJOUTER',
            'attr' => array('class' => 'btn btn-info'),
            ));

        return $form;
    }

    /**
     * Displays a form to create a new Livres entity.
     *
     */
    public function newAction()
    {
        $entity = new Livres();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminBundle:Livres:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Livres entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Livres')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livres entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Livres:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Livres entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Livres')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livres entity.');
        }

      

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
       
        
        return $this->render('AdminBundle:Livres:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a Livres entity.
    *
    * @param Livres $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Livres $entity)
    {
        $form = $this->createForm(new LivresType(), $entity, array(
            'action' => $this->generateUrl('livres_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'MODIFIER',
            'attr' => array('class' => 'btn btn-warning'),
            ));
        
        return $form;
    }
    /**
     * Edits an existing Livres entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        //recuperation de entity dans bdd
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminBundle:Livres')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livres entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);


        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
                
            if ($editForm->isSubmitted()) {
                
                //recup nom image avant modif
                $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/img/collection';               
                $oldFileName = $em->getRepository('AdminBundle:Livres')->getFileNames($id);
                $old=$oldFileName[0]->getImageName();                
                

                $file = $editForm->get('image')->getData();

                if(null !== $file){
                    if(null !== $old){
                        unlink($imagesDir.'/'.$old);
                    }                   
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($imagesDir, $fileName);
                    $entity->setImage($fileName);
                    $entity->setImageName($fileName);
                }else{
                    $entity->setImage($old);
                }
                
               
                
            }
            $em->flush();    
    
            return $this->redirect($this->generateUrl('livres'));
        }

        return $this->render('AdminBundle:Livres:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Livres entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Livres')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Livres entity.');
            }
            //efface image physique
            $imagesDir = $this->container->getParameter('kernel.root_dir').'/../web/img/collection';               
            $oldFileName = $em->getRepository('AdminBundle:Livres')->getFileNames($id);
            $old=$oldFileName[0]->getImageName();
            if(null !== $old){
                unlink($imagesDir.'/'.$old);
            }                
            
            //efface entity
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('livres'));
    }

    /**
     * Creates a form to delete a Livres entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('livres_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'SUPPRIMER  ',
                'attr' => array('class' => 'btn btn-danger'),
                ))
            ->getForm()
        ;
    }
}
