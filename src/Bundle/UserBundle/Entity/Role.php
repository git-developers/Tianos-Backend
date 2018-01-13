<?php

namespace Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string
     *
     */
    private $slug;

    /**
     * @var string
     *
     */
    private $groupRol;

    /**
     * @var string
     *
     */
    private $groupRolTag;

    /**
     * @var \DateTime
     *
     */
    private $createdAt;

    /**
     * @var integer
     *
     */
    private $userCreate;

    /**
     * @var \DateTime
     *
     */
    private $updatedAt;

    /**
     * @var integer
     *
     */
    private $userUpdate;

    /**
     * @var boolean
     *
     */
    private $isActive;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\UserBundle\Entity\Profile", mappedBy="role")
     */
    private $profile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->profile = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

