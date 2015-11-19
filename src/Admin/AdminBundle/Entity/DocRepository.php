<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DocRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DocRepository extends EntityRepository
{
	 public function getFileNames($id)  
    {  
        $query = $this->getEntityManager()->createQuery(
            'SELECT A FROM AdminBundle:Doc A
            WHERE A.id = :id');
            

        $query->setParameter('id', $id);
        try{
            return $query->getResult();
        }
        catch (\Doctrine\Orm\NoResultException $e) {
            return null;
        }        
    }
}
