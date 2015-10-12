<?php
namespace Front\FrontBundle\Services;
use Doctrine\ORM\EntityManager;

class Base
{

	protected $em;

	public function __construct(EntityManager $entityManager) {

    	$this->em = $entityManager;

	}

	private function getDatas($el){

        if($el == 'AdminBundle:Agenda' ){
            $entities = $this->em->getRepository($el)->findBy(array(),array('id'=>'desc')); 
            return $entities;  
        }
        $entities = $this->em->getRepository($el)->findAll();

        return $entities;
	}

	public function recupInfo(){

		$footer   = $this->getDatas('AdminBundle:Footer'); 
        $whois    = $this->getDatas('AdminBundle:Whois');
        $agendas  = $this->getDatas('AdminBundle:Agenda');
    	$sliders  = $this->getDatas('AdminBundle:Slider');


        
    	return array(

    		'sliders'  => $sliders,
            'agendas'  => $agendas,
            'whois'    => $whois,
            'footer'   => $footer,
        );	
	}
}