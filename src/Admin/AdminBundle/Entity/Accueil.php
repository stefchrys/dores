<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accueil
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\AccueilRepository")
 */
class Accueil
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
     * @ORM\Column(name="auteur", type="string", length=255 ,nullable=true)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255 ,nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="collec", type="string", length=255 ,nullable=true)
     */
    private $collec;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text" ,nullable=true)
     */
    private $synopsis;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255 ,nullable=true)
     */
    private $source;

     /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255 ,nullable=true)
     */
    private $image;


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
     * Set auteur
     *
     * @param string $auteur
     * @return Accueil
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Accueil
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set collec
     *
     * @param string $collec
     * @return Accueil
     */
    public function setCollec($collec)
    {
        $this->collec = $collec;

        return $this;
    }

    /**
     * Get collec
     *
     * @return string 
     */
    public function getCollec()
    {
        return $this->collec;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     * @return Accueil
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis
     *
     * @return string 
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Accueil
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Accueil
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
