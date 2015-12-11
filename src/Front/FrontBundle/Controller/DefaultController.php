<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Front\FrontBundle\Entity\Newsletter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; 

class DefaultController extends Controller
{

    private function getDatas($el){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository($el)->findAll();

        return $entities;
    }

   

    private function getPremiereDatas($el){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository($el)->getPremiere();

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
                     
        $premiere = $this->getPremiereDatas('AdminBundle:Livres');
       
        $contenus = $this->getDatas('AdminBundle:Accueil');

        $arr = $this->get('front.base.service')->recupInfo();
        
        $arr['premiere'] = $premiere;
        $arr['contenus'] = $contenus;
        $arr['nav_accueil'] = 'active';
        $arr['nav_xix'] = ' ';
        $arr['nav_essais'] = ' ';
        $arr['nav_litt'] = ' ';
        $arr['nav_audio'] = ' ';
        $arr['nav_video'] = ' ';
        $arr['nav_info'] = ' ';
        $arr['nav_contact'] = ' ';
        $arr['newsletter'] = $form->createView(); 
        $response = new Response();
        if ($request->isMethod('GET')) {
            $response->setPublic();
            $response->setSharedMaxAge(600);
            $response->setVary(array('Accept-Encoding', 'User-Agent'));
        }

      
        return $this->render('FrontBundle:Default:index.html.twig',$arr,$response);

	
	
    }
}
