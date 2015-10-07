<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Whois
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\WhoisRepository")
 */
class Whois
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="row1", type="text" ,nullable=true)
     */
    private $row1;

    /**
     * @var string
     *
     * @ORM\Column(name="row2", type="text" ,nullable=true)
     */
    private $row2;

    /**
     * @var string
     *
     * @ORM\Column(name="row3", type="text" ,nullable=true)
     */
    private $row3;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set row1
     *
     * @param string $row1
     * @return Whois
     */
    public function setRow1($row1)
    {
        $this->row1 = $row1;

        return $this;
    }

    /**
     * Get row1
     *
     * @return string 
     */
    public function getRow1()
    {
        return $this->row1;
    }

    /**
     * Set row2
     *
     * @param string $row2
     * @return Whois
     */
    public function setRow2($row2)
    {
        $this->row2 = $row2;

        return $this;
    }

    /**
     * Get row2
     *
     * @return string 
     */
    public function getRow2()
    {
        return $this->row2;
    }

    /**
     * Set row3
     *
     * @param string $row3
     * @return Whois
     */
    public function setRow3($row3)
    {
        $this->row3 = $row3;

        return $this;
    }

    /**
     * Get row3
     *
     * @return string 
     */
    public function getRow3()
    {
        return $this->row3;
    }
}
