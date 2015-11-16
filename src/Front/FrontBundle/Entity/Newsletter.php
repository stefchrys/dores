<?php
namespace Front\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Newsletter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\NewsletterRepository")
 */
class Newsletter
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
     * @ORM\Column(name="news", type="string", length=255)
     */
    private $news;
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
     * Set news
     *
     * @param string $news
     * @return Newsletter
     */
    public function setNews($news)
    {
        $this->news = $news;
        return $this;
    }
    /**
     * Get news
     *
     * @return string 
     */
    public function getNews()
    {
        return $this->news;
    }
}
