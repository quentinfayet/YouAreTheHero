<?php

namespace Gwyath\Bundle\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gwyath\Bundle\UserBundle\Entity\User;
use Gwyath\Bundle\GameBundle\Entity\Player;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="Gwyath\Bundle\GameBundle\Entity\GameRepository")
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
     * @ORM\JoinColumn(name="gamer", nullable=false)
     */
    private $gamer;

    /**
     * @var Player
     * @ORM\ManyToOne(targetEntity="Gwyath\Bundle\GameBundle\Entity\Player")
     * @ORM\JoinColumn(name="player", nullable=false)
     */
    private $player;


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
}
