<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfoController extends Controller
{
     
        private function getCat($categorie){

		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository('AdminBundle:Info')->getAll($categorie);
		
		return $entities;	
	}

    public function indexAction()
    {

    	$cat1 = $this->getCat('test');
    	$cat2 = $this->getCat('presse');
    	$cat3 = $this->getCat('podcast');

    	$arr = $this->get('front.base.service')->recupInfo();

        $arr['cat1'] = $cat1;
        $arr['cat2'] = $cat2;
        $arr['cat3'] = $cat3;

        
        $arr['nav_accueil'] = ' ';
        $arr['nav_xix'] = ' ';
        $arr['nav_essais'] = ' ';
        $arr['nav_litt'] = ' ';
        $arr['nav_audio'] = ' ';
        $arr['nav_video'] = ' ';
        $arr['nav_info'] = 'active';
       
        return $this->render('FrontBundle:Info:index.html.twig',$arr);
    }

}
