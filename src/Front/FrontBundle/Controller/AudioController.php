<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AudioController extends Controller
{
	
	private function getCat($categorie){

		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository('AdminBundle:Audio')->getAll($categorie);
		
		return $entities;	
	}

    public function indexAction()
    {

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
       
        return $this->render('FrontBundle:Audio:index.html.twig',$arr);
    }

}
