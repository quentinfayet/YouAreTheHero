<?php

namespace Gwyath\Bundle\AdventureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gwyath\Bundle\UserBundle\Entity\User;
use Gwyath\Bundle\AdventureBundle\Entity\Adventure;
use Gwyath\Bundle\AdventureBundle\Entity\PageType;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Gwyath\Bundle\AdventureBundle\Entity\PageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Page
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
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;

    /**
     * @var Adventure
     * @ORM\ManyToOne(targetEntity="Gwyath\Bundle\AdventureBundle\Entity\Adventure")
     * @ORM\JoinColumn(name="adventure_id", nullable=false)
     */
    private $adventure;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Gwyath\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", nullable=false)
     */
    private $author;

    /**
     * @var PageType
     * @ORM\ManyToOne(targetEntity="Gwyath\Bundle\AdventureBundle\Entity\PageType")
     * @ORM\JoinColumn(name="page_type_id", nullable=false)
     */
    private $pageType;


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
     * Set text
     *
     * @param string $text
     * @return Page
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Page
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Page
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->created = new \DateTime();
        $this->modified = $this->created;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->modified = new \DateTime();
    }

    /**
     * Set adventure
     *
     * @param \Gwyath\Bundle\AdventureBundle\Entity\Adventure $adventure
     * @return Page
     */
    public function setAdventure(\Gwyath\Bundle\AdventureBundle\Entity\Adventure $adventure)
    {
        $this->adventure = $adventure;

        return $this;
    }

    /**
     * Get adventure
     *
     * @return \Gwyath\Bundle\AdventureBundle\Entity\Adventure 
     */
    public function getAdventure()
    {
        return $this->adventure;
    }

    /**
     * Set author
     *
     * @param \Gwyath\Bundle\UserBundle\Entity\User $author
     * @return Page
     */
    public function setAuthor(\Gwyath\Bundle\UserBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Gwyath\Bundle\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set pageType
     *
     * @param \Gwyath\Bundle\AdventureBundle\Entity\PageType $pageType
     * @return Page
     */
    public function setPageType(\Gwyath\Bundle\AdventureBundle\Entity\PageType $pageType)
    {
        $this->pageType = $pageType;

        return $this;
    }

    /**
     * Get pageType
     *
     * @return \Gwyath\Bundle\AdventureBundle\Entity\PageType 
     */
    public function getPageType()
    {
        return $this->pageType;
    }
}
