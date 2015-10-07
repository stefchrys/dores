<?php

namespace Admin\AdminBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Slider
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\SliderRepository")
 */
class Slider
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
      * @Assert\File(  mimeTypesMessage = "application/pdf")
     * @ORM\Column(name="source", type="string", length=255 ,nullable=true)
     */
    private $source;

    /**
     * @var string 
     *
     * @ORM\Column(name="sourceName", type="string", length=255,nullable=true)
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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

}
