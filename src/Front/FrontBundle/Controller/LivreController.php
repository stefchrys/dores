<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Enquiry;
use Symfony\Component\HttpFoundation\Request;


class LivreController extends Controller
{
    

    public function indexAction($id, Request $request)
    {
       

    	$livre = $this->getDoctrine()
    	->getRepository('AdminBundle:Livres')
    	->find($id);	    	
    	$arr = $this->get('front.base.service')->recupInfo();
    	$arr['livre'] = $livre;        
        $arr['nav_accueil'] = ' ';
        $arr['nav_xix'] = ' ';
        $arr['nav_essais'] = ' ';
        $arr['nav_litt'] = ' ';
        $arr['nav_audio'] = ' ';
        $arr['nav_video'] = ' ';
        $arr['nav_info'] = ' ';
        
        
       
        return $this->render('FrontBundle:Livre:index.html.twig',$arr);
    }

}
