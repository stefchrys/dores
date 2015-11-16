<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Front\FrontBundle\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EssaisController extends Controller
{
   
        private function getCat($categorie){

		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository('AdminBundle:Livres')->getAll($categorie);
		
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

    	$essais = $this->getCat('essais');
    	

    	$arr = $this->get('front.base.service')->recupInfo();

        $arr['essais'] = $essais;
        $arr['nav_accueil'] = ' ';
        $arr['nav_xix'] = ' ';
        $arr['nav_essais'] = 'active';
        $arr['nav_litt'] = ' ';
        $arr['nav_audio'] = ' ';
        $arr['nav_video'] = ' ';
        $arr['nav_info'] = ' ';
        
         $arr['newsletter'] = $form->createView();
             $response = new Response();
        if ($this->getRequest()->isMethod('GET')) {
            $response->setPublic();
            $response->setSharedMaxAge(1);
            $response->setVary(array('Accept-Encoding', 'User-Agent'));
        }
       
       
        return $this->render('FrontBundle:Essais:index.html.twig',$arr,$response);
    }

}
