<?php

namespace Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"}), @ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"}), @ORM\UniqueConstraint(name="dni_UNIQUE", columns={"dni"})}, indexes={@ORM\Index(name="FK_8D93D649CCFA12B8", columns={"profile_id"}), @ORM\Index(name="fk_user_client1_idx", columns={"client_id"})})
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="device_code", type="string", length=100, nullable=true)
     */
    private $deviceCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dni", type="string", length=8, nullable=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dob", type="date", nullable=true)
     */
    private $dob;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

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
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = '1';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_access", type="datetime", nullable=true)
     */
    private $lastAccess;

    /**
     * @var \Bundle\ProfileBundle\Entity\Profile
     *
     * @ORM\ManyToOne(targetEntity="Bundle\ProfileBundle\Entity\Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     * })
     */
    private $profile;

    /**
     * @var \Bundle\ClientBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Bundle\ClientBundle\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    private $client;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\GroupofusersBundle\Entity\Groupofusers", mappedBy="user")
     */
    private $groupOfUsers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\PointofsaleBundle\Entity\Pointofsale", inversedBy="user")
     * @ORM\JoinTable(name="user_has_point_of_sale",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
     *   }
     * )
     */
    private $pointOfSale;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupOfUsers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pointOfSale = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
