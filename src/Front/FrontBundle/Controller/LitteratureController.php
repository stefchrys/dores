<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Front\FrontBundle\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LitteratureController extends Controller
{
     private function getCat($categorie){

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Livres')->getAll($categorie);
        
        return $entities;   
    }

     private function getTwoDatas($sousCat){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Livres')->getTwo($sousCat);

        return $entities;
    }

    public function indexAction(Request $request)
    {
        //mini formulaire d'abonnement
        $news = new Newsletter();
        $form = $this->createFormBuilder($news)
        ->add('news','email')
        ->add('Envoyer', 'submit')
        ->getForm();
        $form->handleRequest($request);         
        if ($form->isValid()) {
                $email = $news->getNews();
               
                    $message = \Swift_Message::newInstance() 
                    ->setSubject('Bonjour') 
                    ->setFrom($email) 
                    ->setTo('stefchrys@yahoo.fr') 
                    ->setBody('Bonjour Fabrice cet email : '.$email.' souhaite un abonnement à votre newsletter, cordialement') 
                    ; 
                    $this->get('mailer')->send($message);
                    return $this->redirect($this->generateUrl('front_homepage'));
                                                 
            }

        //$litteratures = $this->getCat('litterature');
        $littRoman = $this->getTwoDatas('roman');
        $littTheatre = $this->getTwoDatas('theatre');
        $littPoesie = $this->getTwoDatas('poesie');

        $arr = $this->get('front.base.service')->recupInfo();

        //$arr['litteratures'] = $litteratures;

        $arr['roman'] = $littRoman;
        $arr['theatre'] = $littTheatre;
        $arr['poesie'] = $littPoesie;
        $arr['nav_accueil'] = ' ';
        $arr['nav_xix'] = ' ';
        $arr['nav_essais'] = ' ';
        $arr['nav_litt'] = 'active';
        $arr['nav_audio'] = ' ';
        $arr['nav_video'] = ' ';
        $arr['nav_info'] = ' ';
         $arr['newsletter'] = $form->createView();
       
        return $this->render('FrontBundle:litterature:index.html.twig',$arr);
    }

}
