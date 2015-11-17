<?php

namespace Admin\AdminBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Livres
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\LivresRepository")
 */
class Livres
{
    /**
     * @var string 
     * @Assert\File(  mimeTypesMessage = "application/pdf")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */

    private $image;

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

     /**
     * @var string 
     *
     * @ORM\Column(name="imageName", type="string", length=255, nullable=true)
     */
    private $imageName;

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

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
     * @ORM\Column(name="paypal", type="string", length=255 ,nullable=true)
     */
    private $paypal;
    

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255 ,nullable=true)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="sousTitre", type="text", nullable=true)
     */
    private $sousTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255 ,nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text" ,nullable=true)
     */
    private $synopsis;

    /**
     * @var string
     *
     * @ORM\Column(name="collection", type="string", length=255 ,nullable=true)
     */
    private $collection;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    

     /**
     * @var string
     *
     * @ORM\Column(name="footer", type="string", length=255 ,nullable=true)
     */
    private $footer;

     /**
     * @var boolean
     *
     * @ORM\Column(name="premiere", type="boolean")
     */
    private $premiere;

     /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255 ,nullable=true)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="preface", type="text" ,nullable=true)
     */
    private $preface;

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
     * @return Livres
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
     * Set sousTitre
     *
     * @param string $sousTitre
     * @return Livres
     */
    public function setSousTitre($sousTitre)
    {
        $this->sousTitre = $sousTitre;

        return $this;
    }

    /**
     * Get sousTitre
     *
     * @return string 
     */
    public function getSousTitre()
    {
        return $this->sousTitre;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Livres
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
     * Set synopsis
     *
     * @param string $synopsis
     * @return Livres
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
     * Set collection
     *
     * @param string $collection
     * @return Livres
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * Get collection
     *
     * @return string 
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Livres
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }


    /**
     * Set footer
     *
     * @param string $footer
     * @return Livres
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get footer
     *
     * @return string 
     */
    public function getFooter()
    {
        return $this->footer;
    }

     /**
     * Set premiere
     *
     * @param boolean $premiere
     * @return Livres
     */
    public function setPremiere($premiere)
    {
        $this->premiere = $premiere;
        return $this;
    }

    /**
     * Get premiere
     *
     * @return boolean 
     */
    public function getPremiere()
    {
        return $this->premiere;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Livres
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

     /**
     * Set preface
     *
     * @param string $preface
     * @return Livres
     */
    public function setPreface($preface)
    {
        $this->preface = $preface;

        return $this;
    }

    /**
     * Get preface
     *
     * @return string 
     */
    public function getPreface()
    {
        return $this->preface;
    }

    /**
     * Set paypal
     *
     * @param string $paypal
     * @return Livres
     */
    public function setPaypal($paypal)
    {
        $this->paypal = $paypal;

        return $this;
    }

    /**
     * Get paypal
     *
     * @return string 
     */
    public function getPaypal()
    {
        return $this->paypal;
    }
}
