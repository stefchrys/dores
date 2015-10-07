<?php

namespace Front\FrontBundle\Controller;

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

    public function indexAction()
    {

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
        
       
        return $this->render('FrontBundle:litterature:index.html.twig',$arr);
    }

}
