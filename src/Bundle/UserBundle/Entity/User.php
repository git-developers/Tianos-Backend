<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 */
class User extends BaseUser // implements UserInterface, DomainObjectInterface, \Serializable
{
    /**
     * @var int
     *
     */
    protected $id;

    /**
     * @var string|null
     *
     */
    private $slug;

    /**
     * @var string|null
     *
     */
    private $deviceCode;

    /**
     * @var string|null
     *
     */
    private $dni;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string|null
     *
     */
    private $lastName;

    /**
     * @var \DateTime|null
     *
     */
    private $dob;

    /**
     * @var string|null
     *
     */
    private $address;

    /**
     * @var string|null
     *
     */
    private $phone;

    /**
     * @var string|null
     *
     */
    private $image;

    /**
     * @var \DateTime
     *
     */
    private $createdAt;

    /**
     * @var int|null
     *
     */
    private $userCreate;

    /**
     * @var \DateTime|null
     *
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     */
    private $userUpdate;

    /**
     * @var bool
     *
     */
    private $isActive = '1';

    /**
     * @var bool
     */
    protected $enabled = '1';

    /**
     * @var \DateTime|null
     *
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
     * Set slug
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set deviceCode
     *
     * @param string $deviceCode
     *
     * @return User
     */
    public function setDeviceCode($deviceCode)
    {
        $this->deviceCode = $deviceCode;

        return $this;
    }

    /**
     * Get deviceCode
     *
     * @return string
     */
    public function getDeviceCode()
    {
        return $this->deviceCode;
    }


    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return User
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     *
     * @return User
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }


    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set userCreate
     *
     * @param integer $userCreate
     *
     * @return Product
     */
    public function setUserCreate($userCreate)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return integer
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set userUpdate
     *
     * @param integer $userUpdate
     *
     * @return Product
     */
    public function setUserUpdate($userUpdate)
    {
        $this->userUpdate = $userUpdate;

        return $this;
    }

    /**
     * Get userUpdate
     *
     * @return integer
     */
    public function getUserUpdate()
    {
        return $this->userUpdate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set lastAccess
     *
     * @param \DateTime $lastAccess
     *
     * @return User
     */
    public function setLastAccess($lastAccess)
    {
        $this->lastAccess = $lastAccess;

        return $this;
    }

    /**
     * Get lastAccess
     *
     * @return \DateTime
     */
    public function getLastAccess()
    {
        return $this->lastAccess;
    }

    /**
     * Set profile
     *
     * @param \Bundle\ProfileBundle\Entity\Profile $profile
     *
     * @return User
     */
    public function setProfile(\Bundle\ProfileBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Bundle\ProfileBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set client
     *
     * @param \Bundle\ClientBundle\Entity\Client $client
     *
     * @return User
     */
    public function setClient(\Bundle\ClientBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Bundle\ClientBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add groupOfUser
     *
     * @param \Bundle\GroupofusersBundle\Entity\Groupofusers $groupOfUser
     *
     * @return User
     */
    public function addGroupOfUser(\Bundle\GroupofusersBundle\Entity\Groupofusers $groupOfUser)
    {
        $this->groupOfUsers[] = $groupOfUser;

        return $this;
    }

    /**
     * Remove groupOfUser
     *
     * @param \Bundle\GroupofusersBundle\Entity\Groupofusers $groupOfUser
     */
    public function removeGroupOfUser(\Bundle\GroupofusersBundle\Entity\Groupofusers $groupOfUser)
    {
        $this->groupOfUsers->removeElement($groupOfUser);
    }

    /**
     * Get groupOfUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupOfUsers()
    {
        return $this->groupOfUsers;
    }

    /**
     * Add pointOfSale
     *
     * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
     *
     * @return User
     */
    public function addPointOfSale(\Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale)
    {
        $this->pointOfSale[] = $pointOfSale;

        return $this;
    }

    /**
     * Remove pointOfSale
     *
     * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
     */
    public function removePointOfSale(\Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale)
    {
        $this->pointOfSale->removeElement($pointOfSale);
    }

    /**
     * Get pointOfSale
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPointOfSale()
    {
        return $this->pointOfSale;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles() {
        $roles = [];

        if(is_object($this->getProfile())){
            foreach ($this->getProfile()->getRole() as $key => $role) {
                $roles[] = $role->getSlug();
            }
        }

        $roles[] = 'ROLE_USER';

        return $roles;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getAvatarFileName()
    {
        if(is_object($this->image)){
            return $this->image->getFileName();
        }

        return;
    }

    public function getObjectIdentifier()
    {
        return 'usuario-210'; //$this->username;
    }

    /** @see \Serializable::serialize() */
//    public function serialize()
//    {
//        return serialize(array(
//            $this->id,
//            $this->username,
//            $this->password,
//            // see section on salt below
//            // $this->salt,
//        ));
//    }
//
//    /** @see \Serializable::unserialize() */
//    public function unserialize($serialized)
//    {
//        list (
//            $this->id,
//            $this->username,
//            $this->password,
//            // see section on salt below
//            // $this->salt
//            ) = unserialize($serialized);
//    }


}
