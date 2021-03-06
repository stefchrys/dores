<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * InfoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoRepository extends EntityRepository
{
	public function getAll($categorie)  
    {  
        $query = $this->getEntityManager()->createQuery(
        	'SELECT I FROM AdminBundle:Info I
            WHERE I.categorie = :categorie');

        $query->setParameter('categorie', $categorie);
        return $query->getResult(); 

    } 
}
