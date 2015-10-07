<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Footer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\FooterRepository")
 */
class Footer
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
     * @ORM\Column(name="contact", type="string", length=255 ,nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="diffusion", type="string", length=255 ,nullable=true)
     */
    private $diffusion;


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
     * Set contact
     *
     * @param string $contact
     * @return Footer
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set diffusion
     *
     * @param string $diffusion
     * @return Footer
     */
    public function setDiffusion($diffusion)
    {
        $this->diffusion = $diffusion;

        return $this;
    }

    /**
     * Get diffusion
     *
     * @return string 
     */
    public function getDiffusion()
    {
        return $this->diffusion;
    }
}
