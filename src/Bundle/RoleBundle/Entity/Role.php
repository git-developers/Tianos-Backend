<?php

namespace Bundle\RoleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="Bundle\RoleBundle\Doctrine\ORM\RoleRepository")
 */
class Role
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     */
    private $slug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="group_rol", type="string", length=100, nullable=true)
     */
    private $groupRol;

    /**
     * @var string|null
     *
     * @ORM\Column(name="group_rol_tag", type="string", length=100, nullable=true)
     */
    private $groupRolTag;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="user_create", type="integer", nullable=true)
     */
    private $userCreate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="user_update", type="integer", nullable=true)
     */
    private $userUpdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\ProfileBundle\Entity\Profile", mappedBy="role")
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
