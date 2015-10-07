<?php

namespace Admin\AdminBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Audio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\AudioRepository")
 */
class Audio
{
    /**
     * @var string 
     *
     * @ORM\Column(name="sourceName", type="string", length=255)
     */
    private $sourceName;

    public function getSourceName()
    {
        return $this->sourceName;
    }

    public function setSourceName($sourceName)
    {
        $this->sourceName = $sourceName;

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
     * @ORM\Column(name="lecteur", type="string", length=255 ,nullable=true)
     */
    private $lecteur;

    /**
     * @var string
     *
      * @Assert\File(  mimeTypesMessage = "application/pdf")
     * @ORM\Column(name="source", type="string", length=255 ,nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255 ,nullable=true)
     */
    private $categorie;


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
     * @return Audio
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
     * @return Audio
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
     * Set lecteur
     *
     * @param string $lecteur
     * @return Audio
     */
    public function setLecteur($lecteur)
    {
        $this->lecteur = $lecteur;

        return $this;
    }

    /**
     * Get lecteur
     *
     * @return string 
     */
    public function getLecteur()
    {
        return $this->lecteur;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Audio
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
     * Set categorie
     *
     * @param string $categorie
     * @return Audio
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
}
