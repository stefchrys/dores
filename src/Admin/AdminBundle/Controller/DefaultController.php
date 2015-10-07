<?php

namespace Admin\AdminBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class DefaultController extends Controller
{
    public function indexAction()
    {                       
    	return $this->render('AdminBundle:Default:index.html.twig');
    }
}