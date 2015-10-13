<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Front\FrontBundle\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AudioController extends Controller
{
	
	private function getCat($categorie){

		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository('AdminBundle:Audio')->getAll($categorie);
		
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

    	$cat1 = $this->getCat('cat1');
    	$cat2 = $this->getCat('cat2');
    	$cat3 = $this->getCat('cat3');

    	$arr = $this->get('front.base.service')->recupInfo();

        $arr['cat1'] = $cat1;
        $arr['cat2'] = $cat2;
        $arr['cat3'] = $cat3;


        $arr['nav_accueil'] = ' ';
        $arr['nav_xix'] = ' ';
        $arr['nav_essais'] = ' ';
        $arr['nav_litt'] = ' ';
        $arr['nav_audio'] = 'active';
        $arr['nav_video'] = ' ';
        $arr['nav_info'] = ' ';
         $arr['newsletter'] = $form->createView();
        return $this->render('FrontBundle:Audio:index.html.twig',$arr);
    }

}
