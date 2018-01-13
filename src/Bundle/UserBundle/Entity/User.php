<?php

namespace Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * User
 */
class User
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
    private $username;

    /**
     * @var string
     *
     */
    private $slug;

    /**
     * @var string
     *
     */
    private $deviceCode;

    /**
     * @var string
     *
     */
    private $password;

    /**
     * @var string
     *
     */
    private $salt;

    /**
     * @var string
     *
     */
    private $dni;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string
     *
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     */
    private $dob;

    /**
     * @var string
     *
     */
    private $address;

    /**
     * @var string
     *
     */
    private $email;

    /**
     * @var string
     *
     */
    private $phone;

    /**
     * @var string
     *
     */
    private $image;

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
    private $isActive = '1';

    /**
     * @var \DateTime
     *
     */
    private $lastAccess;

    /**
     * @var \Bundle\UserBundle\Entity\Profile
     *
     * @ORM\ManyToOne(targetEntity="Bundle\UserBundle\Entity\Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     * })
     */
    private $profile;

//    /**
//     * @var \Bundle\UserBundle\Entity\Client
//     *
//     * @ORM\ManyToOne(targetEntity="Bundle\UserBundle\Entity\Client")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id_increment")
//     * })
//     */
//    private $client;
//
//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     *
//     * @ORM\ManyToMany(targetEntity="Bundle\UserBundle\Entity\GroupOfUsers", mappedBy="user")
//     */
//    private $groupOfUsers;
//
//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     *
//     * @ORM\ManyToMany(targetEntity="Bundle\UserBundle\Entity\PointOfSale", inversedBy="user")
//     * @ORM\JoinTable(name="user_has_point_of_sale",
//     *   joinColumns={
//     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
//     *   },
//     *   inverseJoinColumns={
//     *     @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
//     *   }
//     * )
//     */
//    private $pointOfSale;

    /**
     * Constructor
     */
    public function __construct()
    {
//        $this->groupOfUsers = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->pointOfSale = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

