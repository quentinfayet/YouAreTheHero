<?php

namespace Gwyath\Bundle\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gwyath\Bundle\GameBundle\Entity\Game;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gwyath\Bundle\GameBundle\Entity\PlayerRepository")
 */
class Player
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var Game
     * @ORM\ManyToOne(targetEntity="Gwyath\Bundle\GameBundle\Entity\Game")
     * @ORM\JoinColumn(name="game", nullable=false)
     */
    private $game;

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
     * Set name
     *
     * @param string $name
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set game
     *
     * @param \Gwyath\Bundle\GameBundle\Entity\Game $game
     * @return Player
     */
    public function setGame(\Gwyath\Bundle\GameBundle\Entity\Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \Gwyath\Bundle\GameBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }
}
