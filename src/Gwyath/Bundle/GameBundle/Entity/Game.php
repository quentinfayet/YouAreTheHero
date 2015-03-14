<?php

namespace Gwyath\Bundle\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gwyath\Bundle\UserBundle\Entity\User;
use Gwyath\Bundle\GameBundle\Entity\Player;
use Gwyath\Bundle\AdventureBundle\Entity\Adventure;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="Gwyath\Bundle\GameBundle\Entity\GameRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Game
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
     * @var User
     * @ORM\ManyToOne(targetEntity="Gwyath\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="gamer_id", nullable=false)
     */
    private $gamer;

    /**
     * @var Player
     * @ORM\ManyToOne(targetEntity="Gwyath\Bundle\GameBundle\Entity\Player")
     * @ORM\JoinColumn(name="player_id", nullable=false)
     */
    private $player;

    /**
     * @var Adventure
     * @ORM\ManyToOne(targetEntity="Gwyath\Bundle\AdventureBundle\Entity\Adventure")
     * @ORM\JoinColumn(name="adventure_id", nullable=false)
     */
    private $adventure;


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
     * Set created
     *
     * @param \DateTime $created
     * @return Game
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
     * @return Game
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
     * Set gamer
     *
     * @param \Gwyath\Bundle\UserBundle\Entity\User $gamer
     * @return Game
     */
    public function setGamer(\Gwyath\Bundle\UserBundle\Entity\User $gamer)
    {
        $this->gamer = $gamer;

        return $this;
    }

    /**
     * Get gamer
     *
     * @return \Gwyath\Bundle\UserBundle\Entity\User 
     */
    public function getGamer()
    {
        return $this->gamer;
    }

    /**
     * Set player
     *
     * @param \Gwyath\Bundle\GameBundle\Entity\Player $player
     * @return Game
     */
    public function setPlayer(\Gwyath\Bundle\GameBundle\Entity\Player $player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Gwyath\Bundle\GameBundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set adventure
     *
     * @param \Gwyath\Bundle\AdventureBundle\Entity\Adventure $adventure
     * @return Game
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
}
