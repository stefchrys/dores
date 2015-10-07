<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EssaisController extends Controller
{
   
        private function getCat($categorie){

		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository('AdminBundle:Livres')->getAll($categorie);
		
		return $entities;	
	}

    public function indexAction()
    {

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
        
       
        return $this->render('FrontBundle:Essais:index.html.twig',$arr);
    }

}
