<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class XixController extends Controller
{
    private function getCat($categorie){

		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository('AdminBundle:Livres')->getAll($categorie);
		
		return $entities;	
	}

    public function indexAction()
    {

    	$xix = $this->getCat('xix');
    	

    	$arr = $this->get('front.base.service')->recupInfo();

        $arr['xix'] = $xix;

        
        $arr['nav_accueil'] = ' ';
        $arr['nav_xix'] = 'active';
        $arr['nav_essais'] = ' ';
        $arr['nav_litt'] = ' ';
        $arr['nav_audio'] = ' ';
        $arr['nav_video'] = ' ';
        $arr['nav_info'] = ' ';
        
       
        return $this->render('FrontBundle:Xix:index.html.twig',$arr);
    }
        

}
