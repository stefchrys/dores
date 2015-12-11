<?php

namespace Front\FrontBundle\Controller;
use Front\FrontBundle\Entity\Contact;
use Front\FrontBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{

    
    public function indexAction(Request $request)
    {
	$nom_jour_fr = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
	list($nom_jour, $jour, $mois, $annee) = explode('/', date("w/d/n/Y"));
	$jour = $nom_jour_fr[$nom_jour]; 

    	$contact = new Contact();	
	$form = $this->createForm(new ContactType(),$contact);
	$form->handleRequest($request);
			
	if($form->isValid() && $jour == $contact->getCapcha()){
							
		$email = $contact->getEmail();
		$name = $contact->getName();
		$subject = $contact->getSubject();
		$body = $contact->getBody();
		$body = "Message de  ".$name." : ".$body;
		$message= \Swift_Message::newInstance()
		->setSubject($subject)
		->setFrom($email)
		->setTo('stefchrys@yahoo.fr')
		->setBody($body);
		
		$this->get('mailer')->send($message);
		return $this->redirect($this->generateUrl('front_homepage'));		
	}

    	$arr = $this->get('front.base.service')->recupInfo();

        $arr['nav_accueil'] = ' ';
        $arr['nav_xix'] = ' ';
        $arr['nav_essais'] = ' ';
        $arr['nav_litt'] = ' ';
        $arr['nav_audio'] = ' ';
        $arr['nav_video'] = ' ';
        $arr['nav_info'] = ' ';
        $arr['nav_contact'] = 'active';
        $arr['form'] = $form->createView();
                 
        return $this->render('FrontBundle:Contact:index.html.twig',$arr);
    }

}
