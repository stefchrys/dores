<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    

    public function indexAction()
    {
        
        
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
        
                
        return $this->render('FrontBundle:Default:index.html.twig',$arr);
    }
}
